Ext.Loader.setConfig({enabled: true});

Ext.Loader.setPath('Ext.ux', 'js/ux');

Ext.require([
    'Ext.tip.QuickTipManager',
    'Ext.container.Viewport',
    'Ext.layout.*',
    'Ext.form.Panel',
    'Ext.form.Label',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.tree.*',
    'Ext.selection.*',
    'Ext.tab.Panel',
    'Ext.ux.layout.Center',
	
]);

//
// This is the main layout definition.
//
Ext.onReady(function(){
 
    Ext.tip.QuickTipManager.init();

      
    // Gets all layouts examples
    var layoutExamples = [];
    Ext.Object.each(getBasicLayouts(), function(name, example) {
        layoutExamples.push(example);
    });
    
   
    
    // This is the main content center region that will contain each example layout panel.
    // It will be implemented as a CardLayout since it will contain multiple panels with
    // only one being visible at any given time.

    var contentPanel = {
         id: 'content-panel',
         region: 'center', // this is what makes this panel into a region within the containing layout
         layout: 'card',
         margins: '2 5 5 0',
         activeItem: 0,
         border: false,
		 items: layoutExamples
         
    };
     
    var store = Ext.create('Ext.data.TreeStore', {
        root: {
            expanded: true
        },
        proxy: {
            type: 'ajax',
            url: 'admintree-data.json'
        }
    });
    
    // Go ahead and create the TreePanel now so that we can use it below
     var treePanel = Ext.create('Ext.tree.Panel', {
        id: 'tree-panel',
        title: 'Main Menu',
        region:'north',
        split: true,
        height: 500,
        minSize: 150,
        rootVisible: false,
        autoScroll: true,
		listeners:{
        itemclick:function(node,record,ditem,index,e){
      
	      if(!record.data.leaf)node.toggle();
          if(record.data.href){{e.stopEvent(); loadNewPages(record.data.href,record.data.text ,'timeline', 'icon-{1}');}}
        }
        },

		store: store

    });
    
   	
	
	
    
     
    // Finally, build the main layout once all the pieces are ready.  This is also a good
    // example of putting together a full-screen BorderLayout within a Viewport.
    Ext.create('Ext.Viewport', {
        layout: 'border',
        title: 'Ext Layout Browser',
        items: [{
            xtype: 'box',
            id: 'header',
            region: 'north',
            html: '<h1>Adminstrative Center</h1>',
            height: 30
        },{
            layout: 'border',
            id: 'layout-browser',
            region:'west',
            border: false,
            split:true,
            margins: '2 0 5 5',
            width: 275,
            minSize: 100,
            maxSize: 500,
            items: [treePanel]
        }, 
            contentPanel
        ],
        renderTo: Ext.getBody()
    });
});
