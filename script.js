document.addEventListener("DOMContentLoaded", function () {
  const formElements = document.querySelectorAll("input, select, textarea");
  const col = document.querySelectorAll(".col");
  formElements.forEach((element) => {
    element.addEventListener("change", validateInput);
  });

  function validateInput(event) {
    const input = event.target;
    const value = input.value;
    const isValid = checkValidity(input);

    if (isValid) {
      input.style.borderColor = "green";
    } else {
      input.style.borderColor = "red";
    }
  }

  function checkValidity(input) {
    const id = input.id;
    const value = input.value;

    switch (id) {
      case "fullName":
        return /^[A-Za-z\s]+$/.test(value) && value.trim() !== "";
      case "nickname":
        return /^[A-Za-z\s]*$/.test(value);
      case "dateOfBirth":
        return value.trim() !== "";
      case "age":
        return /^[1-9]\d*(?:['"])?$/.test(value) && value >= 18 && value <= 100;
      case "height":
        return /^[1-9]\d*(?:['"])?$/.test(value);
      case "weight":
        return /^[1-9]\d*(?:\s?kg)?$/.test(value);
      case "phone":
        return /^[+]?[0-9]{10,15}$/.test(value);
      case "email":
        return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
      case "address":
        return value.trim() !== "";
      case "education":
        return value.trim() !== "";
      case "income":
        return /^[0-9]{1,10}$/.test(value);
      case "organization":
        return value.trim() !== "";
      case "fatherName":
        return /^[A-Za-z\s]+$/.test(value);
      case "motherName":
        return /^[A-Za-z\s]+$/.test(value);
      case "motherTongue":
        return /^[A-Za-z\s]+$/.test(value);
      case "siblings":
        return /^[0-9]+$/.test(value);
      case "familyType":
        return input.closest(".radio-group").querySelector("input:checked");
      case "familyValues":
        return Array.from(
          input
            .closest(".checkbox-group")
            .querySelectorAll('input[type="checkbox"]')
        ).some((checkbox) => checkbox.checked);
      default:
        return value.trim() !== "";
    }
  }
});
