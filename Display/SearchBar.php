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
    <form action="$this->search_dest" method="post" class="navbar-form navbar-left" role="search">

        <div class="form-group">
            <input type="text" name="item" $prev_item placeholder="Item">
            <input type="text" name="brand" $prev_brand placeholder="Brand (optional)">
        </div>
        <input type="hidden" name="offset" value="0">
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
EOD;
    }
}

?>