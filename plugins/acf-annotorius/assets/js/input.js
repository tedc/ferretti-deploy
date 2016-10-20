(function($){
    var annotations = [];
    var annotations_data = [];
    var isSelection = false;
    var current_annotation,
        current_value,
        current_index;
        
    acf.fields.image_crop = acf.field.extend({

        type: 'annotorius',
        $el: null,
        is_removed : false,
        actions: {
            'ready':    'initialize',
            'append':   'initialize'
        },

        events: {
            'click a[data-name="add"]':     'add',
            'click a[data-name="edit"]':    'edit',
            'click a[data-name="remove"]':  'remove',
            'change input[type="file"]':    'change'
        },

        focus: function(){

            // get elements
            this.$el = this.$field.find('.acf-image-uploader');

            // get options
            this.o = acf.get_data( this.$el );
        },

        initialize: function(){
            // add attribute to form
            if( this.o.uploader == 'basic' ) {

                this.$el.closest('form').attr('enctype', 'multipart/form-data');
            }
            var type = this.o.annotoriousType;
            var img= this.$el.find('[data-name="image"]');
            var field = this.$el;
            var notes = field.find('[data-name="annotorius-annotation"]');
            var data = field.find('[data-name="annotorius-annotation_data"]')
            if (notes.val()) {
                annotations = JSON.parse(notes.val());
            }
            if(type == 'polygon') {
                anno.addPlugin('PolygonSelector', { activate : true} );
            }
            // ADD ANNOTATION STORED ON LOAD
            var src = img.attr('src');
            this.$el.observe('added', '.annotorious-annotationlayer', function(record) {
                addAnnotations( notes );
            });
            // CREATE ANNOTATION ON IMAGE LOAD
            updateAnnotations( field );
            onResizeCanvas();
            annotoriousPopup( field );
            field.find('.annotorious-buttons').on('click', '.save', function() {
                addAnnotationData( field, current_annotation, annotations, notes, data );
            }); 
            field.find('.annotorious-buttons').on('click', '.update, .delete', function() {
                var obj = {
                    index : current_index,
                    anno_data :  current_value,
                    data : data,
                    annotation : current_annotation,
                    annotations : annotations,
                    annotations_data : annotations_data,
                    notes : notes,
                    field : field
                }
                updateOrDeleteData(obj);
                hideAnnoPop(field);
            });
            var annotation_to_close = (isSelection) ? current_annotation : false;
            cancelBtn(annotation_to_close, field);
        },

        add: function() {
            // reference
            var self = this,
                $field = this.$field;


            // get repeater
            var $repeater = acf.get_closest_field( this.$field, 'repeater' );


            // popup
            var frame = acf.media.popup({

                title:      acf._e('image', 'select'),
                mode:       'select',
                type:       'image',
                field:      acf.get_field_key($field),
                multiple:   $repeater.exists(),
                library:    this.o.library,
                mime_types: this.o.mime_types,

                select: function( attachment, i ) {

                    // select / add another image field?
                    if( i > 0 ) {

                        // vars
                        var key = acf.get_field_key( $field ),
                            $tr = $field.closest('.acf-row');


                        // reset field
                        $field = false;


                        // find next image field
                        $tr.nextAll('.acf-row:visible').each(function(){

                            // get next $field
                            $field = acf.get_field( key, $(this) );


                            // bail early if $next was not found
                            if( !$field ) {

                                return;

                            }


                            // bail early if next file uploader has value
                            if( $field.find('.acf-image-uploader.has-value').exists() ) {

                                $field = false;
                                return;

                            }


                            // end loop if $next is found
                            return false;

                        });


                        // add extra row if next is not found
                        if( !$field ) {

                            $tr = acf.fields.repeater.doFocus( $repeater ).add();


                            // bail early if no $tr (maximum rows hit)
                            if( !$tr ) {

                                return false;

                            }


                            // get next $field
                            $field = acf.get_field( key, $tr );

                        }

                    }

                    // focus
                    self.doFocus( $field );


                    // render
                    self.render( self.prepare(attachment) );

                }

            });

        },

        prepare: function( attachment ) {
            // vars
            var image = {
                id:     attachment.id,
                url:    attachment.attributes.url
            };


            // check for preview size
            if( acf.isset(attachment.attributes, 'sizes', this.o.preview_size, 'url') ) {

                image.url = attachment.attributes.sizes[ this.o.preview_size ].url;
            }


            // return
            return image;

        },

        render: function( image ){    
            if(image.url != '') {
                this.is_removed = false;
            }
            
            // set atts
            var img = this.$el.find('[data-name="image"]')
            img.attr( 'src', image.url );
            this.$el.find('[data-name="annotorius-image"]').val( image.id ).trigger('change');
            var notes = this.$el.find('[data-name="annotorius-annotation"]');
            // set div class
            this.$el.addClass('has-value');
            // CREATE ANNOTATION ON IMAGE LOAD
            this.$el.observe('added', '.annotorious-annotationlayer', function() {
                //$(window).trigger('resize');
            });
        },

        edit: function() {
            // reference
            var self = this;

            // popup
            var frame = acf.media.popup({

                title:      acf._e('image', 'edit'),
                type:       'image',
                button:     acf._e('image', 'update'),
                mode:       'edit',

                select: function( attachment, i ) {

                    self.render( self.prepare(attachment) );

                }

            });

        },

        remove: function() {
            var url = this.$el.find('[data-name="image"]').attr('src');
            // vars
            var attachment = {
                id:     '',
                url:    ''
            };
            // clean annotation
            
            cleanAllAnnotations(this.$el, url);
            
            // add file to field
            this.render( attachment );
            
            // remove class
            this.$el.removeClass('has-value');

        },

        change: function( e ){

            this.$el.find('[data-name="annotorius-image"]').val( e.$el.val() );

        }

    });
    
    function updateAnnotations(field) {
        var notes = field.find('[data-name="annotorius-annotation"]');
        var data = field.find('[data-name="annotorius-annotation_data"]');
        anno.addHandler('onAnnotationCreated', function(annotation) {
            annotations.push(annotation);
            notes.val(JSON.stringify(annotations));
        });
        anno.addHandler('onAnnotationRemoved', function(annotation) {
            var index = anno.getAnnotations(field.find('[data-name="image"]').attr('src')).indexOf(annotation);
            annotations.splice(index, 1); 
            if(annotations.length < 1) {
                notes.removeAttr('value');
            } else {
                notes.val(JSON.stringify(annotations));
            }
        });
        anno.addHandler('onAnnotationUpdated', function(annotation) {
            var txt = annotation.text;
            var index = anno.getAnnotations(field.find('[data-name="image"]').attr('src')).indexOf(annotation);
            annotations[index].text = txt;
            notes.val(JSON.stringify(annotations));
        });
        anno.addHandler('onSelectionStarted', function() {
            isSelection = true;
        });
        anno.addHandler('onSelectionCompleted', function(annotation) {
            field.find('.annotorious-popup-field')
                .css(
                    {
                        top : annotation.viewportBounds.bottom,
                        left : annotation.viewportBounds.top
                    }
                )
                .show();
            current_annotation = annotation;
            isSelection = false;
        });
        anno.addHandler('onMouseOverAnnotation', function(annotation) {
            if(isSelection) {
                return;
            }
            current_annotation = annotation.C;
            var coords = annotation.mouseEvent;
            var stored = anno.getAnnotations(field.find('[data-name="image"]').attr('src'));
            current_index = stored.indexOf(current_annotation);
            current_value = JSON.parse(data.val());
            if(current_value[current_index]) {
                var kind = current_value[current_index].kind;
                var value = (kind == 'floor') ? current_value[current_index].floor : (kind == 'house') ? current_value[current_index].house : null;
                field.find('[name="render_kind"]')
                    .val(kind)
                    .trigger('change')
                field.find('[name="'+kind+'"]')
                    .val(value)
                    .trigger('change');

                field.find('.annotorious-popup-field')
                    .css(
                        {
                            top : coords.offsetY,
                            left : coords.offsetX
                        }
                    );
            }
            if(current_index !== -1) {
                field.find('.annotorious-popup-field').show().addClass('filled')
            } else {
                hideAnnoPop(field);
            }
        });
    }
    
    function annotoriousPopup(field) {
        field.find('[name="render_kind"]').on('change', function() {
            field.find('[data-render-type]').hide();
            field.find('[data-render-type="'+ $(this).val() +'"]').show();
        })
    }
    
    function cancelBtn(annotation, field) {
        field.find('.annotorious-buttons').on('click', '.cancel', function() {
            if(annotation) {
                anno.stopSelection(annotation);
            } else {
                anno.stopSelection()
            }
            field.find('.annotorious-popup-field').hide().removeClass('filled');
            $(window).trigger('resize');
        });
    }
    
    function hideAnnoPop(field) {
        field
            .find('.annotorious-popup-field').hide().removeClass('filled');
        field.find('[name="render_kind"]')
            .val('')
            .trigger('change')
        field.find('[name="floor"]')
            .val('')
        field.find('[name="house"]')
            .val('')
            .trigger('change');
        isSelection = false;
    }
    
    function deleteAnnotationData(obj) {
        obj.annotations_data.splice(obj.index, 1);
        obj.annotations.splice(obj.index, 1);
        anno.removeAnnotation(obj.annotation);
        if(obj.anno_data.length > 0) {
            obj.data.val(JSON.stringify(obj.annotations_data));
            obj.notes.val(JSON.stringify(obj.annotations));
        } else {
            obj.data.removeAttr('value');
            obj.notes.removeAttr('value');
        }
    }
    
    function updateAnnotationData(obj) {
        obj.annotations_data[obj.index] = obj.value;
        obj.data.val(JSON.stringify(obj.annotations_data));
    }
    
    function updateOrDeleteData(c) {
        var anno_kind = c.field.find('[name="render_kind"]').val()
        if(anno_kind != '') {
            if((anno_kind=='floor' || anno_kind == 'house') && field.find('[name="'+anno_kind+'"]').val() == '') {
                return;
            }
            var data_value = (anno_kind == 'floor' || anno_kind == 'house') ? c.field.find('[name="'+anno_kind+'"]').val() : null;
            var anno_value = (anno_kind != 'room') ? (anno_kind == 'floor') ? {kind : anno_kind, floor : data_value } : {kind : anno_kind, house : data_value } : { kind : anno_kind };
            var obj = {
                index : c.index,
                anno_data : c.anno_data,
                data : c.data,
                value : anno_value,
                annotation : c.annotation,
                annotations : annotations,
                annotations_data : annotations_data,
                notes : c.notes
            }
            if($(this).hasClass('update')) {
                updateAnnotationData(obj);
            }
        } else {
            var obj = {
                index : c.index,
                data : c.data,
                value : anno_value,
                annotation : c.annotation,
                annotations : annotations,
                annotations_data : annotations_data,
                notes : c.notes
            }
            if($(this).hasClass('delete')) {
                deleteAnnotationData(obj);
            } else {
                return;
            }
        }
    }
    
    function addAnnotationData(field, annotation, annotations, notes, data) {
        var value = {
            text : '',
            src : field.find('[data-name="image"]').attr('src'),
            shapes : [ annotation.shape ]
        }
        var selected = field.find('[name="render_kind"] option:selected').val();
        var floor = field.find('[name="floor"]').val()
        var house = field.find('[name="house"] option:selected').val()
        if(selected != '') {
            if(selected == 'floor' && floor != '') {
                var obj = {
                    kind: selected,
                    floor: floor
                };
            } else if(selected == 'house' && house != '') {
                var obj = {
                    kind: selected,
                    house: house
                };
            } else {
                var obj = {
                    kind: selected
                }
            }
            if((selected == 'floor' || selected == 'house') && field.find('[name="'+selected+'"]').val() == '' ) {
                return;
            }
            hideAnnoPop(field);
            annotations_data.push(obj);
            data.val(JSON.stringify(annotations_data));
            anno.addAnnotation(value);
            annotations.push(value);
            notes.val(JSON.stringify(annotations));
        } else {
            return;
        }
        $(window).trigger('resize');
    }
    
    function cleanAllAnnotations(field, url) {
        field.find('[data-name="annotorius-annotation"], [data-name="annotorius-annotation_data]').removeAttr('value');
        annotations = []
        annotations_data = []
        is_removed = true;
        anno.removeAll(url);
    }
    
    function addAnnotations( notes ) {
        if(!notes.val()) {
             return;
        }
        var notes = JSON.parse(notes.val());
        for(var i = 0; i < notes.length; i ++){
            anno.addAnnotation(notes[i]);
        }
    }
    
    function onResizeCanvas() {
        $(window).on('resize', function() {
            $('.annotorious-annotationlayer').each(function() {
                var url = $(this).find('.annotatable');
                var notes = $(this).closest('.acf-image-annotorius').find('[data-name="annotorius-annotation"]');
                anno.reset()
                addAnnotations(notes);
            })
        });
    }

})(jQuery);
