document.addEventListener("DOMContentLoaded", function() {
  const stars = document.querySelectorAll(".stars i");
  const starValues = [1, 2, 3, 4, 5]; // Values corresponding to each star

  stars.forEach((star, index1) => {
    star.addEventListener("click", () => {
      stars.forEach((star, index2) => {
        if (index1 >= index2) {
          star.classList.add("active");
          // Assign the value of the clicked star to a hidden input field
          document.getElementById("rating").value = starValues[index1];
        } else {
          star.classList.remove("active");
        }
      });
    });
  });
});
