<?php namespace Display;

use \Interfaces\ISearchBar as ISearchBar;

class SearchBar implements ISearchBar
{
    private $search_dest = '';

    public function __construct($search_output)
    {
        $this->search_dest = $search_output;
    }
    
    public function display($id,$class,$prev_item,$prev_brand)
    {
        $id = is_string($id) ? 'id="'.$id.'"' : "";
        $class = is_string($class) ? 'class="'.$class.'"' : "";
        $prev_item = is_string($prev_item) ? 'value="'.$prev_item.'"' : "";
        $prev_brand = is_string($prev_brand) ? 'value="'.$prev_brand.'"' : '';
        return <<<EOD
<div $id $class >
<h1>Search</h1>
            <form action="$this->search_dest" method="post">
                <div class="row">
                    <div class="col-md-2">
                        Item: 
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="item" $prev_item>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                        Brand (optional):
                    </div>
                    <div class="col-md-2">
                       <input type="text" name="brand" $prev_brand> 
                    </div>
                </div> 
                <input type="hidden" name="offset" value="0">
                <br>
                <input type="submit" name="Search">
            </form>
</div>
EOD;
    }
}

?>