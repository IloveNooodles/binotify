<?php

function return_html($data = []){
  $all_user = users_in_html($data);
  $html = <<<"EOT"
    <body>
    <table id="userlist">
        <tr class="row-title">
          <th>#</th>
          <th>Username</th>
          <th>Email</th>
        </tr>
      $all_user
    </table>
    </body>
EOT;
echo $html;
}

function users_in_html($data){
  $str = "";
  $cnt = 1;
  foreach($data as $user){
    $username = $user['username'];
    $email = $user['email'];
    $html = <<<"EOT"
    <tr class="content">
      <td>$cnt</td>
      <td>$username</td>   
      <td>$email</td>   
    </tr>
EOT;
    $str = $str . $html;
    $cnt += 1;
  }
  return $str;
}

return_html($data);