<?php
function find_random_item($params = array())
{
    $db = get_db();
    $table = $db->getTable('Item');

    $select = new Omeka_Db_Select;
    $select->from(array('i'=>$db->Item), array('i.*'));
    $select->from(array(), 'RAND() as rand');
    $select->order('rand DESC');

    if ($params['withImage']) {
        $select->joinLeft(array('f'=>"$db->File"), 'f.item_id = i.id', array());
        $select->where('f.has_derivative_image = 1');
    }

    $table->applySearchFilters($select, $params);

    $select->limit(1);

    $item = $table->fetchObject($select);

    return $item;
}

?>

<?php
function display_random_featured_collection_with_item()
{

    $featuredCollection = random_featured_collection();
    $html = '<h2>Featured Collection</h2>';
    if ($featuredCollection) {

        $item = find_random_item(array('withImage' => true, 'collection' => $featuredCollection->id));

        $html .= '<h3>' . link_to_collection($collectionTitle, array(), 'show', $featuredCollection) . '</h3>';
        if (item_has_thumbnail($item)) {
            $html .= link_to_item(item_square_thumbnail(array(), 0, $item), array('class'=>'image'), 'show', $item);
        }
        if ($collectionDescription = collection('Description', array('snippet'=>150), $featuredCollection)) {
            $html .= '<p class="collection-description">' . $collectionDescription . '</p>';
        }
    } else {
        $html .= '<p>No featured collections are available.</p>';
    }
    return $html;
}
?>