document.addEventListener("DOMContentLoaded", function () {
  const qtyInput = document.querySelector(".qty-input");
  const minusBtn = document.querySelector(".qty-btn.minus");
  const plusBtn = document.querySelector(".qty-btn.plus");

  console.log("External script loaded!");

  if (minusBtn) {
    minusBtn.addEventListener("click", function (e) {
      e.preventDefault();
      let currentValue = parseInt(qtyInput.value) || 1;
      if (currentValue > 1) {
        qtyInput.value = currentValue - 1;
      }
    });
  }

  if (plusBtn) {
    plusBtn.addEventListener("click", function (e) {
      e.preventDefault();
      let currentValue = parseInt(qtyInput.value) || 1;
      qtyInput.value = currentValue + 1;
    });
  }
});
