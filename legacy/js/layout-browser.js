/*!
 * Ext JS Library 3.3.1
 * Copyright(c) 2006-2010 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */

//
// This is the main layout definition.
//
Ext.onReady(function(){
	
	Ext.QuickTips.init();
	
	// This is an inner body element within the Details panel created to provide a "slide in" effect
	// on the panel body without affecting the body's box itself.  This element is created on
	// initial use and cached in this var for subsequent access.
	var detailEl;
	
	var start = {
    id: 'start-panel',
    xtype: 'tabpanel',
    plain: true,  //remove the header border
    activeTab: 0,
    defaults: {bodyStyle: 'padding:15px'},
    items:[{
        title: 'State Home Page'
        
    }],
    contentEl: 'start-div'  // pull existing content from the page
};

 
	
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
		items: [
			// from basic.js:
			start
		]
	};
    
	// Go ahead and create the TreePanel now so that we can use it below
    var treePanel = new Ext.tree.TreePanel({
    	id: 'tree-panel',
        title: 'Main Menu',
        region:'north',
        split: true,
        height: 500,
        minSize: 150,
        rootVisible: false,
        autoScroll: true,
        
        // tree-specific configs:
        rootVisible: false,
        lines: false,
        singleExpand: true,
        useArrows: true,
        
        loader: new Ext.tree.TreeLoader({
            dataUrl:'admintree-data.json'
        }),
        
        root: new Ext.tree.AsyncTreeNode()
    });
    
	// Assign the changeLayout function to be called on tree node click.
    treePanel.on('click', function(n,e){
    	 if(!n.leaf)n.toggle();
          if(n.attributes.href){{e.stopEvent(); loadNewPages(n.attributes.href,n.text ,'timeline', '');}}
    	
    });
	
	   
	
	
	// Finally, build the main layout once all the pieces are ready.  This is also a good
	// example of putting together a full-screen BorderLayout within a Viewport.
    new Ext.Viewport({
		layout: 'border',
		title: 'Ext Layout Browser',
		items: [{
            xtype: 'box',
            id: 'header',
            region: 'north',
            html: '',
            height: 70
        },{
			layout: 'fit',
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
