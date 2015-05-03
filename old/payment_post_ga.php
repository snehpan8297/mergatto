<script type="text/javascript">

/**
 * Creates a temporary global ga object and loads analy  tics.js.
 * Paramenters o, a, and m are all used internally.  They could have been declared using 'var',
 * instead they are declared as parameters to save 4 bytes ('var ').
 *
 * @param {Window}      i The global context object.
 * @param {Document}    s The DOM document object.
 * @param {string}      o Must be 'script'.
 * @param {string}      g URL of the analytics.js script. Inherits protocol from page.
 * @param {string}      r Global name of analytics object.  Defaults to 'ga'.
 * @param {DOMElement?} a Async script tag.
 * @param {DOMElement?} m First script tag in document.
 */
(function(i, s, o, g, r, a, m){
  i['GoogleAnalyticsObject'] = r; // Acts as a pointer to support renaming.

  // Creates an initial ga() function.  The queued commands will be executed once analytics.js loads.
  i[r] = i[r] || function() {
    (i[r].q = i[r].q || []).push(arguments)
  },

  // Sets the time (as an integer) this tag was executed.  Used for timing hits.
  i[r].l = 1 * new Date();

  // Insert the script tag asynchronously.  Inserts above current tag to prevent blocking in
  // addition to using the async attribute.
  a = s.createElement(o),
  m = s.getElementsByTagName(o)[0];
  a.async = 1;
  a.src = g;
  m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-35971078-1', 'auto'); // Creates the tracker with default parameters.
ga('send', 'pageview');            // Sends a pageview hit.


</script>
<?php
//Lang confirm
	include_once("./include/inbd.php");

	
$payment["id_order"]=1924;
	
$table='order_request';
$filter=array();
$filter["id_order"]=array("operation"=>"=","value"=>$payment["id_order"]);
$order=getInBD($table,$filter);
$order["revenue"]=round(($order["total_with_discount"]-$order["shipping_method_price"])/1.21,2);

$order["shipping"]=round($order["shipping_method_price"],2);
$order["tax"]=round(($order["total_with_discount"]-$order["shipping_method_price"])-$order["revenue"],2);

$trans = array('id'=>$order["id_order"], 'affiliation'=>'Oky^Coky Classics','revenue'=>$order["revenue"], 'shipping'=>$order["shipping"], 'tax'=>$order["tax"]);

$table='lines_order_request';
$filter=array();
$filter["id_order_request"]=array("operation"=>"=","value"=>$payment["id_order"]);
$lines=listInBD($table,$filter);
$items = array();
foreach($lines as $key=>$line){
	$items[]=array('sku'=>$line["serial_model_code"], 'name'=>$line["serial_model_code"], 'category'=>'Clothes', 'price'=>$line["unitary_price"], 'quantity'=>$line["subclothes"]);
}

// Function to return the JavaScript representation of a TransactionData object.
function getTransactionJs(&$trans) {
  return <<<HTML
ga('ecommerce:addTransaction', {
  'id': '{$trans['id']}',
  'affiliation': '{$trans['affiliation']}',
  'revenue': '{$trans['revenue']}',
  'shipping': '{$trans['shipping']}',
  'tax': '{$trans['tax']}'
});
HTML;
}

// Function to return the JavaScript representation of an ItemData object.
function getItemJs(&$transId, &$item) {
  return <<<HTML
ga('ecommerce:addItem', {
  'id': '$transId',
  'name': '{$item['name']}',
  'sku': '{$item['sku']}',
  'category': '{$item['category']}',
  'price': '{$item['price']}',
  'quantity': '{$item['quantity']}'
});
HTML;
}

?>
s
<!-- Begin HTML -->
<script>
ga('require', 'ecommerce');

<?php
echo getTransactionJs($trans);

foreach ($items as &$item) {
  echo getItemJs($trans['id'], $item);
}
?>

ga('ecommerce:send');
alert("send");
</script>
H
