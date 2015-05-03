<?php
//Lang revisado
@session_start();
include ("./include/bdOC.php");

if (!(isset($_SESSION['admin']))) {
    header("location:./admin.php");
}
    $lang=$_SESSION["lang"];
    $lang_url='./lang/lang_'.$lang.'.php';
    include_once($lang_url);
$lines = getSeasonLines($_POST["id_season"]);

/*
 * 
 */
                        for ($sesion=0;$sesion<sizeof($lines["name_season"]);$sesion++){
                        ?>
                        <span class="checkbox_list"><input type="checkbox" class="chline" name="lines[]" checked value='<?php echo $lines["id_season"][$sesion];?>'><?php echo utf8_encode($lines["name_season"][$sesion]);?> (<?php echo $lines["num_models"][$sesion]." Modelos";?>)</span> 
                        <?php
                        }
                        echo "</div><span class='label'>Series:<br/><a class='important underline' href='javascript:selectseries(1)'>".$s["select_all"]."</a> / <a class='important underline' href='javascript:selectseries(0)'>".$s["unselect_all"]."</a></span><div class='checkbox_content'>";
$series=getSeasonSeries($_POST["id_season"]);
$i=0;
foreach ($series["series"] as $key=>$value) { ?>
    	<span class="checkbox"><input type="checkbox" class="chline1" name="series[]" checked value='<?php echo $value;?>'><?php echo utf8_encode($value);?></span>
    	<?php
}
echo "</div><span class='label'>Colores:<br/><a class='important underline' href='javascript:selectcolors(1)'>".$s["select_all"]."</a> / <a class='important underline' href='javascript:selectcolors(0)'>".$s["unselect_all"]."</a></span><div class='checkbox_content'>";
$colors=getSeasonColors($_POST["id_season"]);
                        $available=array();
                        for ($sesion=0;$sesion<sizeof($colors["name"]);$sesion++){
                            //$res1=explode("-",$colors["name"][$sesion]);
                            //if (sizeof($res1)<2) continue; 
                            if (!in_array($colors["number"][$sesion], $available)) {
                                $available[]=$colors["number"][$sesion];
                            }
                        }

                        for ($sesion=0;$sesion<sizeof($available);$sesion++){
                        ?>
                        <span class="checkbox"><input type="checkbox" class="chline2" name="colors[]" checked value='<?php echo $available[$sesion];?>'><?php echo utf8_encode($available[$sesion]);?></span>
                        <?php
                   
                        }

?>
</div></span></div>