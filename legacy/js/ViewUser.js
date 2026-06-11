// JavaScript Document// extjs functons
var dstore;
var grdExp;
var strname =""
var strfname =""

Ext.onReady(function(){
    Ext.QuickTips.init();

  var proxy = new Ext.data.HttpProxy({
        url: 'Utility/LoadUser.php',
	    method: 'post',
			
    });
  
  var myReader = new Ext.data.JsonReader({   
        idProperty: 'user_id',
        root: 'rows',
        totalProperty: 'total'},
       [ 
		{name: 'user_id', type: 'int'},
        {name: 'username', type: 'string'},
        {name: 'state', type: 'string'},
		{name: 'privilege', type: 'string'}
      ]
	  );

  	
	
	 

    dstore = new Ext.data.Store({
	 id: 'dstore',	
	 baseParams: {
           name: strname,
           fname: strfname      
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
	    {header: "Name", width: 250,  sortable: false, dataIndex: 'state'},
		 {header: "User Name", width: 250,  sortable: false, dataIndex: 'username'}
	   
        ],
        stripeRows: true,
        height:400,
        width: 700,
        title:'List of User ',
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
  var prez =  selections[0].json.user_id;
  var shell = window.top;
  var theUrl = "EditUser.php?"+prez
  shell.loadNewPages(theUrl,"Edit User","timeline","")    	
 }
 

function Search()
{
	strname = ""
	strfname = ""
	txtname =  document.getElementById("txtName")
	if(txtname != undefined && txtname != null)
    {
	    strname = txtname.value; 
	}	
	
	txtfullname =  document.getElementById("txtfullName")
	if(txtfullname != undefined && txtfullname != null)
    {
	    strfname = txtfullname.value; 
	}	
		 
	 grdExp.getEl().mask("Searching...");
	 dstore.baseParams = { name: strname, fname: strfname}
	 dstore.load();          // reload our datastore.
	 setTimeout("grdExp.getEl().unmask()",500);
          
}
  

