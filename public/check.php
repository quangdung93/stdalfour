<?php
	echo strtoupper(substr("abcdef", 0, 1));
	opcache_reset();
	echo 'Đã xóa cache thành công';
?>