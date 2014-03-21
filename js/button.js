(function() {
   tinymce.create('tinymce.plugins.galeries', {
      init : function(ed, url) {
         ed.addButton('galeries', {
            title : 'Galeries',
            image : url+'/gallery.png',
            onclick : function() {
               var galeries = prompt("Number of galeries", "1");

               if (galeries != null && galeries != '' && !isNaN(galeries) )
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