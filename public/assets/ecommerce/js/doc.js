
/**
 * Wolmart Documentation Javascript File
 */
"use strict";

( function () {
	/**
	 * @var templates {title, text} array of id
	 */
    var templates = [],
        activeId = 'template-welcome';

    var Docs = {
        init: function () {
            var self = this;

            // find and remove all script templates
            var len = document.scripts.length;

            for ( var i = 0; i < len; ++i ) {
                var script = document.scripts[i];
                if ( script.type === 'text/html' ) {
                    templates[script.id] = {
                        text: script.text
                    };
                    script.parentNode.removeChild( script );
                    --len, --i;
                }
            }

            // get titles
            $( 'aside .document-link' ).each( function () {
                var $this = $( this ),
                    id = $this.attr( 'href' ).slice( 1 );
                templates[id] && (
                    templates[id].title = $this.data( 'title' )
                )
            } );

            // # Register events
            Wolmart.$body.on( 'click', '.document-link', function ( e ) {
                self.open( e.currentTarget.getAttribute( 'href' ).slice( 1 ) );
                var mainContent = Wolmart.byClass( 'main-content' );
                mainContent.length && $( 'html' ).animate( { scrollTop: mainContent[0].offsetTop }, 600 );
            } );

            if ( location.hash ) {
                self.open( location.hash.slice( 1 ) );
            }

            $( '.btn-search' ).click( function () {
                self.search( this.previousElementSibling.value );
            } );

            $( '.input-search' ).keydown( function ( e ) {
                e.keyCode === 13 && self.search( this.value );
            } );
        },

        open: function ( id ) {
            // active new
            id && templates[id] && ( activeId = id );

            // show active
            if ( activeId && templates[activeId] ) {
                Wolmart.byId( 'document-view' ).innerHTML = templates[activeId].text;
                Wolmart.byId( 'document-title' ).textContent = templates[activeId].title;
                Wolmart.byId( 'document-view' ).classList.remove( 'search-result' );
            }
            $( Wolmart.byClass( 'document-link' ) ).parent( 'li' ).removeClass( 'show' );
            $( '.document-link[href="#' + id + '"]' ).parent().addClass( 'show' );
        },

        search: function ( query ) {

            var searchText = query.trim();

            if ( searchText == '' ) {
                this.open();
                return;
            }
            if ( searchText.length < 3 ) {
                // do nothing
                return;
            }

            var results = [];

            Wolmart.byId( 'document-title' ).textContent = 'Search Result';

            // Perform search
            for ( var id in templates ) {
                var count = 0, result;
                result = templates[id].text.replace( new RegExp( searchText, 'gi' ), function ( match, offset, string ) {
                    var i = 0;
                    for ( i = offset; i >= 0; --i ) {
                        if ( string[i] === '<' ) {
                            return match;
                        }
                        if ( string[i] === '>' ) {
                            break;
                        }
                    }
                    for ( i = offset; offset[i]; ++i ) {
                        if ( string[i] === '>' ) {
                            return match;
                        }
                        if ( string[i] === '<' ) {
                            break;
                        }
                    }

                    ++count;
                    return '<mark>' + match + '</mark>';
                } );

                if ( count > 0 ) {
                    results.push( {
                        id: id,
                        count: count,
                        text: '<div class="search-pane"><sup class="search-count">' + count + '</sup>' + result + '</div>'
                    } );
                }
            }

            // Process result
            var finalResult = '';
            results.sort( function ( a, b ) {
                return b.count - a.count;
            } );
            for ( var id in results ) {
                finalResult += results[id].text;
            }
            Wolmart.byId( 'document-view' ).innerHTML = finalResult ? finalResult : '<h5 class="text-center">Nothing Found</h5>';
            Wolmart.byId( 'document-view' ).classList.add( 'search-result' );
        }
    }

    Wolmart.docs = Docs;
    $( window ).on( 'wolmart_complete', function () {
        Wolmart.docs && Wolmart.docs.init();
    } )
} )();