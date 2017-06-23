<div class="samples index">

<h1><?php echo __('Display Case', true);?></h1>
       
     <ul class="gallery display">
			<?php foreach ($samples as $sample):?>
                 <li>
                   <?php 
                    if (!empty($sample['Attachment'])){
                          $image_url =
                          $sample['Attachment'][0]['Attachment']['path'].
                          $versionInfo['Thumbnail']['prefix'].
                          $sample['Attachment'][0]['Attachment']['filename'];
                          $options =array('alt'=> $sample['Attachment'][0]['Attachment']['title_'.$lang], 'title'=>$sample['Attachment'][0]['Attachment']['title_'.$lang]);
                     }else {
                           $image_url = '/files/samples/missing_image_thumb.gif';
                           $options=array();
                      }
					  echo $html->link($html->image($image_url), array('controller'=>'samples', 'action'=>'display', $sample['Sample']['id']), array('escape'=>false));

							?> 
                     <p><?php echo $html->link($sample['Sample']['name_'.$lang],  array('controller'=>'samples', 'action'=>'display', $sample['Sample']['id']));?></p>
                          
                   </li>
               <?php endforeach; ?>
           </ul> 
	
</div>

<?php if ($lang == 'eng'):?>
<h2> </h2>
<h2>Department of Mineralogy - Petrology - Economic Geology</h2>
<h3>Research Fields</h3>
<ul>
   <li>Mineralogy</li>
   <li>Petrology</li>
   <li>Ore Deposits</li>
   <li>Geochemistry</li>
   <li>Crystal Chemistry</li>
   <li>Mining and Economic Geology</li>
   <li>Applied Mineralogy and Petrology</li>
   <li>Fossil Fuels (Petroleum, Coal, Natural Gas)</li>
   <li>Geochronology - Isotopic Geology</li>
   <li>Applied and Environmental Geochemistry</li>
   <li>Research and Exploitation of  Marbles</li>
   <li>Research and Exploitation of  Building Materials</li>
   <li>Clays and Clay Minerals</li>
   <li>Industrial Rocks nd Minerals</li>
   <li>Environmental Surveys</li>
   <li>Archaeometry</li>
   <li>Electron Microscopy</li>
   <li>Natural Resources and Environment</li>
   <li>Volcanology</li>
</ul>
<?php endif?>
<?php if ($lang == 'gr'):?>
<h2> </h2>
<h2>ΤΜΗΜΑ ΓΕΩΛΟΓΙΑΣ</h2>
<h3>Τομέας Ορυκτολογίας - Πετρολογίας - Κοιτασματολογίας</h3>
<h4>Ερευνητικά Πεδία</h4>
<ul>
    <li>Ορυκτολογία</li>
    <li>Πετρολογία</li>
    <li>Κοιτασματολογία</li>
    <li>Γεωχημεία</li>
    <li>Ορυκτοχημεία - Κρυσταλλοχημεία</li>
    <li>Γεωλογία μεταλλείων και Οικονομική Γεωλογία</li>
    <li>Εφαρμοσμένη Ορυκτολογία και Πετρολογία</li>
    <li>Ορυκτά Καύσιμα (Πετρέλαιο, Ανθρακες, Φυσικό Αέριο)</li>
    <li>Γεωχρονολογήσεις - Ισοτοπική Γεωλογία</li>
    <li>Εφαρμοσμένη και Περιβαλλοντική Γεωχημεία</li>
    <li>Έρευνα και Εκμετάλλευση Αδρανών Υλικών</li>
    <li>Έρευνα και Εκμετάλλευση Μαρμάρων</li>
    <li>Αργιλοι και Αργιλικά Ορυκτά</li>
    <li>Βιομηχανικά Ορυκτά και Πετρώματα</li>
    <li>Μελέτες Περιβαλλοντικών Επιπτώσεων</li>
    <li>Αρχαιομετρία</li>
    <li>Ηλεκτρονική Μικροσκοπία</li>
    <li>Ορυκτές Πρώτες Ύλες και Περιβάλλον</li>
    <li>Ηφαιστειολογία</li>


</ul>

<?php endif?>