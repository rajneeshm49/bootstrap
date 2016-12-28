<script type="text/javascript">

function loadListingPage(urlStr,curpage)
{	
	var pageNo = document.getElementById("pagingBarPageNo").value;
	if(urlStr.search("page=") > 1){
		var urlStr = urlStr.replace("page="+curpage, "page="+pageNo);
	} else {
		var n = urlStr.search(/\?/i); 
		if(n > 0) {
			var urlStr = urlStr + "&page="+pageNo;
		} else {
			var urlStr = urlStr + "?page="+pageNo;
		}
		
		
	}
	if(isNaN(pageNo))
	{
		document.getElementById("pagingBarPageNo").value = '';
		document.getElementById("pagingBarPageNo").focus();
	}
	else{
		var urlStr = urlStr.replace("%5BPage%5D="+curpage, "%5BPage%5D="+pageNo);
		//var urlStr = urlStr.replace("page="+curpage, "page="+pageNo);
		loadUrl(urlStr);
	}
}
function loadUrl(url)
{
	location.href = url;
}
</script>
<?php $pages = $this->Paginator->request->params['paging'][$module];

unset($paginateParams['page']);?>
<?php $page_numbers = array();
$pagination_url =  PAGINATION_URL.$this->request->here();
for($i= 1; $i <= $pages['pageCount']; $i++)
{
$page_numbers[$i] = $i;
}?>
<?php // pr( $pages);?>
<nav aria-label="Page navigation" class="padding-right15">
  <ul class="pagination">
  		<li class="page-item">
		  <?php echo "Go to "?>
		  <?php echo $this->Form->select('Pagination.Page', 
							$page_numbers,
							[
								'empty' => false,
								'value' => $pages['page'],
								'class' => 'selectbox',
								'id' => 'pagingBarPageNo',
								'style' => 'width:70px;height:28px;',
								'onChange' => 'javascript:loadListingPage(\''. $pagination_url.'\',\''.$pages['page'].'\')'
							]);
							
					?>	
		  </li>	
  </ul>
  <ul class="pagination pull-right">
  <?php
  $prevPage = $pages['page'] - 1;
                      if($prevPage) {
  ?>
    <li class="page-item">
                        <?php echo $this->Html->link("<span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span>",
						    array_merge($paginateParams, ['action' => 'index', '?' => ['page' => $prevPage]]),
						    ['aria-label' => "Previous", 'class' => 'page-link', 'escape' => false]
               			);
                        ?>
                        </li>
    <?php } else {
    	?>
    	
    	<li class="disabled"><span aria-hidden='true'>&laquo;</span></li>
    	<?php 
    }
    
     for($i = 1; $i <= $pages['pageCount']; $i++ ) {
                    ?>
                            <li class="page-item <?= ($i == $pages['page'] )?'disabled':'' ?>">
                                <?php echo $this->Html->link($i,
						    array_merge($paginateParams, ['action' => 'index', '?' => ['page' => $i]]),
						    ['class' => 'page-link', 'escape' => false]
               			); ?>
                            </li>
                    <?php 
                        }
                    ?>
    
    <?php 
                    $nextPage = $pages['page'] + 1;
                    if($pages['page'] < $pages['pageCount']) {?>
                    <li class="page-item">
                        <?php echo $this->Html->link("<span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span>",
						    array_merge($paginateParams, ['action' => 'index', '?' => ['page' => $nextPage]]),
						    ['aria-label' => "Next", 'class' => 'page-link', 'escape' => false]
               			);
                        ?>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="disabled"><span aria-hidden='true'>&raquo;</span></li>
                        <?php 
                    }?>
  </ul>
</nav>