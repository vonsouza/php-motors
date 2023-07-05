<footer>
    <div class="footer_motors">
        <hr>
        <p>&copy; PHP Motors. All Rights Reserved.</p>
        <p>All images used are believed to be in "Fair Use". Please notify the author if any are not and they will be removed.</p>
        <p class="last-update" id="current-date"></p>
    </div>
</footer>

<script>
  // Get the current date
  var currentDate = new Date();

  // Format the date as "Month Day, Year" (e.g., "May 20, 2023")
  var formattedDate = currentDate.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });

  // Set the formatted date in the footer
  document.getElementById("current-date").textContent = formattedDate;
</script>