  // Wait until the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', function () {
    // Find the message element
    var messageElement = document.querySelector('.message');

    // If the element exists
    if (messageElement) {
        // After 3 seconds, remove the element from the DOM
        setTimeout(function () {
            messageElement.remove();
        }, 3000);
    }
});