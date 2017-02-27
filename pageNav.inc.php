<?php if($step>0 && $step<5){
	for($i=0;$i<$step+3 && $i<$countNum;++$i){
		if($step==$i+1) {?>
			<button style="background-color:grey;"><a style="color:black;" href="#"><?php echo $i+1; ?></a></button>
<?php } else{ ?>
			<button><a style="color:white;" href="<?php echo $url.'?step='.urlencode($i+1); ?>"><?php echo $i+1; ?></a></button>
			<?php }
					} }
	else{
		for($i=$step-4;$i<$step+3 && $i<$countNum;++$i){ 
			if($step==$i+1) {?>
				<button><a style="color:white;" href="#"><?php echo $i+1; ?></a></button>
	<?php } else{ ?>
				<button><a style="color:white;" href="<?php echo $url.'?step='.urlencode($i+1); ?>"><?php echo $i+1; ?></a></button>
			<?php }
				}
			}
		?>