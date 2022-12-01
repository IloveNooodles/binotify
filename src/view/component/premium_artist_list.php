<?php

function return_html($data = []){
$all_user = users_in_html($data);
$html = <<<"EOT"
	<body>
	<table id="premiumArtistList">
		<tr class="row-title">
			<th>#</th>
			<th>PREMIUM ARTIST</th>
			<th>SUBSCRIPTION</th>
		</tr>
	$all_user
	</table>
	</body>
EOT;
echo $html;
}

function users_in_html($data){
$html = <<<"EOT"
	<tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="subscribe" value="1">Subscribe</button>
		</td>
	</tr>
	<tr class="content">
		<td>2</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>   
		<td>
			<a href="/subscribed/1">
				<button class="go-to-songs" value="2">Go To Songs</button>
			</a>
		</td>   
	</tr>
	<tr class="content">
		<td>3</td>
		<td>
			<p class="artist-name">Roman Sombong Asu</p>
		</td>   
		<td>
			<button class="rejected" value="3">Rejected</button>
		</td>   
	</tr>
		<tr class="content">
		<td>4</td>
		<td>
			<p class="artist-name">Roman Sombong Asu</p>
		</td>   
		<td>
			<button class="pending" value="111">Pending...</button>
		</td>   
	</tr>
  <tr class="content">
		<td>1</td>
		<td>
			<p class="artist-name">Roman Irama</p>
		</td>
		<td>
			<button class="subscribe" value="111">Subscribe</button>
		</td>
	</tr>
EOT;
return $html;
}

return_html($data);