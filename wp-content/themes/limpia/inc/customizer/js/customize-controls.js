( function( $ ) { 'use strict';

    $( document ).ready( function() {

        wp.customizerCtrlEditor = {

        init: function() {

            $(window).load(function(){

                $('textarea.wp-editor-area').each(function(){
                    var tArea = $(this),
                        id = tArea.attr('id'),
                        input = $('input[data-customize-setting-link="'+ id +'"]'),
                        editor = tinyMCE.get(id),
                        setChange,
                        content;

                    if(editor){
                        editor.onChange.add(function (ed, e) {
                            ed.save();
                            content = editor.getContent();
                            clearTimeout(setChange);
                            setChange = setTimeout(function(){
                                input.val(content).trigger('change');
                            },500);
                        });
                    }

                    if(editor){
                        editor.onChange.add(function (ed, e) {
                            ed.save();
                            content = editor.getContent();
                            clearTimeout(setChange);
                            setChange = setTimeout(function(){
                                input.val(content).trigger('change');
                            },500);
                        });
                    }

                    tArea.css({
                        visibility: 'visible'
                    }).on('keyup', function(){
                        content = tArea.val();
                        clearTimeout(setChange);
                        setChange = setTimeout(function(){
                            input.val(content).trigger('change');
                        },500);
                    });
                });
            });
        }

    };

    wp.customizerCtrlEditor.init();


    } ); // $( document ).ready

    $( window ).load( function() {

        var radio_input = $( '#customize-control-portfolio_header_setting' ),
            selected_value = $("input[name='_customize-radio-portfolio_header_setting']:checked").val();

            if ( 'slider' == selected_value ) {
               $( '#customize-control-featured_category_select').show();
               $( '#customize-control-featured_slider_cat_exclude').show();
               $( '#customize-control-featured_posts_number').show();
               $( '#customize-control-featured_autoplay').show();
               $( '#customize-control-portfolio_headline_text').hide();
            } else if ( 'headline' == selected_value ) {
               $( '#customize-control-featured_category_select').hide();
               $( '#customize-control-featured_slider_cat_exclude').hide();
               $( '#customize-control-featured_posts_number').hide();
               $( '#customize-control-featured_autoplay').hide();
               $( '#customize-control-portfolio_headline_text').show();
            } else {
               $( '#customize-control-featured_category_select').hide();
               $( '#customize-control-featured_slider_cat_exclude').hide();
               $( '#customize-control-featured_posts_number').hide();
               $( '#customize-control-featured_autoplay').hide();
               $( '#customize-control-portfolio_headline_text').hide();
            }

        $( radio_input ).change( function() {
            selected_value = $("input[name='_customize-radio-portfolio_header_setting']:checked").val();

            // Show / Hide elements depending on selection

            if ( 'slider' == selected_value ) {
               $( '#customize-control-featured_category_select').show();
               $( '#customize-control-featured_slider_cat_exclude').show();
               $( '#customize-control-featured_posts_number').show();
               $( '#customize-control-featured_autoplay').show();
               $( '#customize-control-portfolio_headline_text').hide();
            } else if ( 'headline' == selected_value ) {
               $( '#customize-control-featured_category_select').hide();
               $( '#customize-control-featured_slider_cat_exclude').hide();
               $( '#customize-control-featured_posts_number').hide();
               $( '#customize-control-featured_autoplay').hide();
               $( '#customize-control-portfolio_headline_text').show();
            } else {
               $( '#customize-control-featured_category_select').hide();
               $( '#customize-control-featured_slider_cat_exclude').hide();
               $( '#customize-control-featured_posts_number').hide();
               $( '#customize-control-featured_autoplay').hide();
               $( '#customize-control-portfolio_headline_text').hide();
            }

        } );

    } );

} ) ( jQuery );

