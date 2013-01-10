<?PHP
$this->load->helper('url');
?>
<link href="http://localhost/secondarySchoolPortal/assets/css/main.css" rel="stylesheet" type="text/css">
   

<div class="formatDivTbl" style="overflow:scroll; min-width:1000px;">
  <table border="0" cellspacing="1" cellpadding="4" width="100%">
    <tbody>
      <tr class="menuText3">
          <td class="lightBlueBack">No.</th>
          <td class="lightBlueBack"><a href="#">Admission No</a></th>
          <td class="lightBlueBack"><a href="#">Student Name</a></th>
          <td class="lightBlueBack"><a href="#">Gender</a></th>
          <td class="lightBlueBack"><a href="#">Class</a></th>
          <?PHP
          $x = count($subjects);
          for($i=0; $i<$x; $i++)
          {
          ?>
          <td class="lightBlueBack"><a href="#"><?PHP echo $subjects[$i]['subjectName']; ?></a></th>
          <?PHP
          }
          ?>
          <td class="lightBlueBack"><a href="#">Status</a></th>
          <td class="lightBlueBack">Actions</th>
      </tr>
      <?PHP
          $x = count($studentResultGrid);
          $counter = 0;
          //echo $x.' '.$startFrom;
          for($i=0; $i<$x; $i++)
          {
      ?>
      <tr class="menutext">
          <td><?PHP echo ($counter+1); ?></td>
          <td><?PHP echo $studentResultGrid[$i]['admissionNumber']; ?></td>
          <td><?PHP echo $studentResultGrid[$i]['lastname'].' '.$studentResultGrid[$i]['middlename'].' '.$studentResultGrid[$i]['firstname']; ?></td>
          <td><?PHP echo $studentResultGrid[$i]['gender']; ?></td>
          <td><?PHP echo $studentResultGrid[$i]['className']; ?></td>
          <?PHP
              $g = count($subjects);
              for($j=0; $j<$g; $j++)
              {
          ?>
          <td><?PHP echo $studentResultGrid[$i]['subject'.$j]; ?></td>
          <?PHP
              }
          ?>
          <td><?PHP echo 'Active'; ?></td>
          <td style="width: 96px;">
          <a href="<?PHP echo site_url("student/profile/".$studentResultGrid[$i]['studentID']); ?>">Profile</a>
          </td>
      </tr>
      <?PHP
              $counter++;
              /*if($counter == $perpage)
                  break;*/
          }
      ?>
      
    </tbody>
</table>
</div>