<table class="table">
  <thead>
    <tr>
      <th scope="col">Branch Name</th>
      <th scope="col">Total Courier</th>
      <th scope="col">Total Price</th>
    </tr>
  </thead>
  <tbody>
    <?php  
      while($row3 = $result->fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row3['bname'];?></td>
      <td><?=$row3['total_courier'];?></td>
      <td><?=$row3['total_price'];?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>