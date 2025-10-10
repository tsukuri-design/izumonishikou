<footer>
    <div class="logo"><a href="https://www.izumonishikou.jp/"><?php echo Svg::LOGO_WHITE()->get(); ?></a></div>
    <p class="text">〒693-0032 島根県出雲市下古志町1163<br>TEL <a href="tel:0853-21-1183">0853-21-1183</a> FAX 0853-21-1397</p>
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