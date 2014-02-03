<script>
$(document).ready(function(){
var DataSource = function (options) {
	this._formatter = options.formatter;
	this._columns = options.columns;
	this._data = options.data;
	};

	DataSource.prototype = {

		columns: function () {
			return this._columns;
		},

		data: function (options, callback) {

			var self = this;
			if (options.search) {
				callback({ data: self._data, start: start, end: end, count: count, pages: pages, page: page });
	        } else if (options.data) {
				callback({ data: options.data, start: 0, end: 0, count: 0, pages: 0, page: 0 });
			} else {
				callback({ data: self._data, start: 0, end: 0, count: 0, pages: 0, page: 0 });
			}
		}
	};

	var treeDataSource = new DataSource({
	  data: [
	        { name: 'Folder 1', type: 'folder', additionalParameters: { id: 'F1' },
	          data: [
	            { name: 'Sub Folder 1', type: 'folder', additionalParameters: { id: 'FF1' } },
	            { name: 'Sub Folder 2', data: [
	              {name: 'sub sub folder 1', type: 'folder', additionalParameters: { id: 'FF21' }},
	                {name: 'sub sub item', type: 'item', additionalParameters: { id: 'FI2' }}
	            	], type: 'folder', additionalParameters: { id: 'FF2' }},
	            { name: 'Item 2 in Folder 1', type: 'item', additionalParameters: { id: 'FI2' } }
	          	]
	        },
	        { name: 'Folder 2', type: 'folder', additionalParameters: { id: 'F2' } },
	        { name: 'Item 1', type: 'item', additionalParameters: { id: 'I1' } },
	        { name: 'Item 2', type: 'item', additionalParameters: { id: 'I2' } }
	      ],
				delay: 400
			});

			$('#MyTree').tree({dataSource: treeDataSource});

			$('#tree-selected-items').on('click', function () {
				console.log("selected items: ", $('#MyTree').tree('selectedItems'));
			});

			$('#MyTree').on('loaded', function (evt, data) {
				console.log('tree content loaded');
			});

			$('#MyTree').on('opened', function (evt, data) {
				console.log('sub-folder opened: ', data);
			});

			$('#MyTree').on('closed', function (evt, data) {
				console.log('sub-folder closed: ', data);
			});

			$('#MyTree').on('selected', function (evt, data) {
				console.log('item selected: ', data);
			});
});

</script>
<div class="row">
    <div class="col-md-12">
    	<div class="portlet purple box">
    		<div class="portlet-title">
    			<div class="caption">
    				<i class="fa fa-cogs"></i>
    			</div>
    			<div class="tools">
    				<a href="javascript:;" class="collapse"></a>
    				<a href="#portlet-config" data-toggle="modal" class="config"></a>
    				<a href="javascript:;" class="reload"></a>
    				<a href="javascript:;" class="remove"></a>
    			</div>
    		</div>
    		<div class="portlet-body">
    			<div id="MyTree" class="tree tree-plus-minus tree-solid-line tree-unselectable">
    				<div class="tree-folder" style="display:none;">
    					<div class="tree-folder-header">
    						<i class="fa fa-folder"></i>
    						<div class="tree-folder-name">
    						</div>
    					</div>
    					<div class="tree-folder-content">
    					</div>
    					<div class="tree-loader" style="display:none">
    					</div>
    				</div>
    				<div class="tree-item" style="display:none;">
    					<i class="tree-dot"></i>
    					<div class="tree-item-name">
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>