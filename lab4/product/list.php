<?php
$dom = new DOMDocument();
$dom->load('files/data.xml');
$products = $dom->getElementsByTagName('products')->item(0);
?>
<style>
    .container-fuild{
        font-size: 25px;
        background: #7b8aff;
        font-family: "Old English Text MT";

    }
    th{
        color: black;
    }


</style>
<body>
<div class="container-fuild">
    <div class="card">
        <div class="card-header">
            <h2>List products</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                $product=$products->getElementsByTagName('product');
                while (is_object($product->item($i++))){
                    ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $product->item($i-1)->getElementsByTagName('name')->item(0)->nodeValue?></td>
                    <td><?php echo $product->item($i-1)->getElementsByTagName('price')->item(0)->nodeValue?></td>
                    <td><?php echo $product->item($i-1)->getElementsByTagName('description')->item(0)->nodeValue?></td>
                    <td><a href="index.php?page_layout=update&id=<?php echo  $product->item($i-1)->getElementsByTagName('id')->item(0)->nodeValue; ?>"> Edit <?php echo  $product->item($i-1)->getElementsByTagName('id')->item(0)->nodeValue; ?></a></td>
                    <td><a onclick="return Del('<?php echo $product->item($i-1)->getElementsByTagName('id')->item(0)->nodeValue;?>//')"  href= "index.php?page_layout=delete&id=<?php echo  $product->item($i-1)->getElementsByTagName('id')->item(0)->nodeValue; ?>" >Delete</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="index.php?page_layout=create">Add</a>
        </div>
    </div>
</div>
</body>
<script>
    function Del(name){
        return confirm("вы точно хотите удалить? "+name+" ?");
    }
</script>