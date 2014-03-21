(function() {
   tinymce.create('tinymce.plugins.galeries', {
      init : function(ed, url) {
         ed.addButton('galeries', {
            title : 'Galeries',
            image : url+'/gallery.png',
            onclick : function() {
               jQuery('#gallery-plugin.prompt').css('z-index', '100');
               jQuery('#gallery-plugin.prompt').show();
               jQuery('#gallery-plugin.prompt form').submit(function(e){
                  e.preventDefault();
                  this.onSubmit();
               });
            },
            onSubmit : function(){
               var galeries = jQuery('#gallery-plugin.prompt').val();
               if (galeries != null && galeries != '' )
                  ed.execCommand('mceInsertContent', false, '[slider id_gallery="'+galeries+'"]');
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Galeries",
            author : 'Manuel Lemaire',
            authorurl : 'http://www.manuellemaire.com',
            infourl : 'http://www.manuellemaire.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('galeries', tinymce.plugins.galeries);
})();