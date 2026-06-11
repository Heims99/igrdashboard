// JavaScript Document// extjs functons
var dstore;
var grdExp;
var strname =""

Ext.onReady(function(){
    Ext.QuickTips.init();

  var proxy = new Ext.data.HttpProxy({
        url: 'Utility/LoadUserType.php',
	    method: 'post',
			
    });
  
  var myReader = new Ext.data.JsonReader({   
        idProperty: 'ID',
        root: 'rows',
        totalProperty: 'total'},
       [ 
		{name: 'ID', type: 'int'},
        {name: 'Name', type: 'string'},
        {name: 'Description', type: 'string'}
      ]
	  );

  	
	
	 

    dstore = new Ext.data.Store({
	 id: 'dstore',	
	 baseParams: {
           name: strname
                 
      },
	 proxy:proxy,
     reader:myReader,
	 remoteSort: true,	
     autoLoad: true	   
	
    });
  

    
        grdExp = new Ext.grid.EditorGridPanel({
        id:'grdExp',
	    store: dstore,
		renderTo: 'grid-example',
        columns: [
	    {header: "Name", width: 350,  sortable: false, dataIndex: 'Name'},
		 {header: "Description", width: 500,  sortable: false, dataIndex: 'Description'}
	   
        ],
        stripeRows: true,
        height:400,
        width: 900,
        title:'List of User Types',
		  tbar: [{
          text: 'Edit',
          tooltip: '',
          handler: EditExps,   // Confirm before deleting
          iconCls:'edit1'
        }],
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false})
    });
     
	dstore.load();
   
  
      
});




function EditExps()
 {	
  var selections = grdExp.selModel.getSelections();
  var prez =  selections[0].json.ID;
  var shell = window.top;
  var theUrl = "EditUserType.php?"+prez
  shell.loadNewPages(theUrl,"Edit UserType","timeline","")    	
 }
 

function Search()
{
	strname = ""
	txtname =  document.getElementById("txtName")
	if(txtname != undefined && txtname != null)
    {
	    strname = txtname.value; 
	}	
		 
	 grdExp.getEl().mask("Searching...");
	 dstore.baseParams = { name: strname}
	 dstore.load();          // reload our datastore.
	 setTimeout("grdExp.getEl().unmask()",500);
          
}
  

