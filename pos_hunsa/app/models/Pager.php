<?php 

// pagination class
class Pager
{	
	// Number of records to display per page
	protected $limit = 10;
	// Current offset for fetching records
	public $offset = 0;
	// Number of steps (pagination links) to show on each side of the current page
	public $steps = 2;

	// Constructor to initialize the pagination.
     	// @param int $limit The number of records to display per page.
	public function __construct($limit = 10)
	{
		$this->limit = (int)$limit;
		
		$page_number = $this->get_page_number();
		$this->offset = ($page_number - 1) * $this->limit;
	}

	// Get the current page number from the URL or default to 1.
     	// @return int The current page number.
	protected function get_page_number()
	{
		$page_number = $_GET['page'] ?? 1;
		$page_number = (int)$page_number;

		// Ensure the page number is at least 1
		if($page_number < 1)
		{
			$page_number = 1;
		}
		return $page_number;
	}

	
    	// Create a page link URL with the specified page number.
	// @param int $page The page number for the link.
     	// @return string The constructed page link URL.
	protected function create_page_link($page)
	{
		// Reconstruct the URL by modifying the 'page' parameter
		$url = "index.php?";
		$url2 = "";
		foreach ($_GET as $key => $value) {
			if($key == 'page'){
				$url2 .= "&".$key ."=$page";
			}else{
				$url2 .= "&".$key ."=".$value;
			}
		}
		$url2 = trim($url2,"&");
		// Ensure 'page' parameter is included in the URL
		if(!strstr($url2, "page="))
		{
			$url2 .= "&page=$page";
		}
		$url .= $url2;
		return $url;
	}

	// Display the pagination links.
     	// @param int|null $rec_count The total number of records (null if unknown).
	public function display($rec_count = null)
	{
		if(!$rec_count){
			$rec_count = $this->limit;
		}

		if($rec_count < $this->limit){
			return;
		}

		 // Get the current page number
		$page_number = $this->get_page_number();
		?>

		<!-- Pagination navigation -->
		<nav aria-label="...">
		  	<ul class="pagination">
				<!-- First page link -->
				<li class="page-item">
					<a class="page-link" href="<?=$this->create_page_link(1)?>">First</a>
				</li>	

		    	 	<!-- Previous page link -->
		 		<li class="page-item">
		 			<?php 

		 				$num = $page_number - 1;
		 				$num = ($num < 1) ? 1 : $num;
		 			?>
		      		<a class="page-link" href="<?=$this->create_page_link($num)?>">Prev</a>
		    		</li>

				<!-- Page links on the left side of the current page -->
				<?php 
				$x = $this->steps;
				for ($i=1; $i <= $this->steps; $i++) { 

					if(($page_number - $x) < 1){
						$x--;
						continue;
					}

					echo '
					<li class="page-item">
						<a class="page-link" href="'.$this->create_page_link($page_number - $x).'">'.$page_number - $x.'</a>
					</li>';
					$x--;
				}
				?>

				<!-- Current page link (active) -->
				<li class="page-item active">
					<a class="page-link" href="<?=$this->create_page_link($page_number)?>"><?=$page_number?></a>
				</li>
		    
				<!-- Next page link -->
				<?php 
				for ($i=1; $i <= $this->steps; $i++) { 
					echo '
					<li class="page-item">
						<a class="page-link" href="'.$this->create_page_link($page_number + $i).'">'.$page_number + $i.'</a>
					</li>';
				}
				?>
				<li class="page-item">
					<a class="page-link" href="<?=$this->create_page_link($this->get_page_number() + 1)?>">Next</a>
				</li>	
		  	</ul>
		</nav>
	<?php 

	}

}