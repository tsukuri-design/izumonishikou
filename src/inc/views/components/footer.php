<footer>
    <div class="logo"><?php echo picture('', 'logo_white', 'png', '', '', '', '', '', ''); ?></div>
    <p class="text">〒693-0032 島根県出雲市下古志町1163<br>TEL 0853-21-1183 FAX 0853-21-1397</p>
    <p class="copy en">&copy;2025 IZUMO NISHI HIGH SCHOOL</p>
</footer>
</div>
<!-- directoryLevel PHPで変更の必要あります -->
<script>
    const directoryLevel = "<?php echo $this->directoryLevel(); ?>";
    </script>
<!-- /directoryLevel -->
<?php echo $this->jsLoad(); ?>
</body>

</html>