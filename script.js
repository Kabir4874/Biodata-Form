document.addEventListener("DOMContentLoaded", function () {
  // Image preview functionality
  const profilePhotoInput = document.getElementById("profilePhoto");
  const photoPreview = document.querySelector(".photo-preview");

  if (profilePhotoInput && photoPreview) {
    profilePhotoInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        // Validate image file type
        const validTypes = ["image/jpeg", "image/png", "image/gif"];
        if (!validTypes.includes(file.type)) {
          alert("Please upload an image file (JPEG, PNG, or GIF)");
          this.value = "";
          return;
        }

        // Validate image size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
          alert("Image must be less than 2MB");
          this.value = "";
          return;
        }

        const reader = new FileReader();
        reader.addEventListener("load", function () {
          photoPreview.src = this.result;
        });
        reader.readAsDataURL(file);
      }
    });
  }

  // Form validation
  const formElements = document.querySelectorAll("input, select, textarea");
  formElements.forEach((element) => {
    element.addEventListener("change", validateInput);
    element.addEventListener("blur", validateInput);
  });

  function validateInput(event) {
    const input = event.target;
    const isValid = checkValidity(input);

    if (isValid) {
      input.style.borderColor = "green";
      clearError(input);
    } else {
      input.style.borderColor = "red";
      showError(input, getErrorMessage(input));
    }
  }

  function clearError(input) {
    const errorElement = input.nextElementSibling;
    if (errorElement && errorElement.classList.contains("error-message")) {
      errorElement.remove();
    }
  }

  function showError(input, message) {
    clearError(input);
    if (message) {
      const errorElement = document.createElement("div");
      errorElement.className = "error-message";
      errorElement.style.color = "red";
      errorElement.style.fontSize = "0.8rem";
      errorElement.style.marginTop = "5px";
      errorElement.textContent = message;
      input.parentNode.insertBefore(errorElement, input.nextSibling);
    }
  }

  function getErrorMessage(input) {
    const id = input.id;
    const value = input.value;
    const isRequired = input.hasAttribute("required");

    if (isRequired && value.trim() === "") {
      return "This field is required";
    }

    switch (id) {
      case "fullName":
        if (!/^[A-Za-z\s.]+$/.test(value))
          return "Only letters, spaces and periods allowed";
        break;
      case "nickname":
        if (!/^[A-Za-z\s]*$/.test(value))
          return "Only letters and spaces allowed";
        break;
      case "dateOfBirth":
        if (new Date(value) > new Date()) return "Date cannot be in the future";
        if (new Date().getFullYear() - new Date(value).getFullYear() < 18)
          return "Must be at least 18 years old";
        break;
      case "age":
        if (!/^\d+$/.test(value)) return "Numbers only";
        if (value < 18) return "Must be at least 18";
        if (value > 100) return "Please enter valid age";
        break;
      case "height":
        if (!/^[0-9'\"\s]+$/.test(value))
          return "Valid formats: 5'8\" or 172cm";
        break;
      case "weight":
        if (!/^[0-9\skg]+$/.test(value)) return "Valid formats: 65 or 65 kg";
        break;
      case "gender":
        if (!document.querySelector('input[name="gender"]:checked'))
          return "Please select gender";
        break;
      case "religion":
        if (isRequired && !value) return "Please select religion";
        break;
      case "caste":
        if (!/^[A-Za-z\s]+$/.test(value))
          return "Only letters and spaces allowed";
        break;
      case "motherTongue":
        if (!/^[A-Za-z\s]+$/.test(value))
          return "Only letters and spaces allowed";
        break;
      case "email":
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value))
          return "Valid email required";
        break;
      case "phone":
        if (!/^[+]?[0-9]{10,15}$/.test(value))
          return "10-15 digit phone number";
        break;
      case "address":
        if (isRequired && value.trim().length < 10) return "Address too short";
        break;
      case "education":
        if (isRequired && !value) return "Please select education";
        break;
      case "degree":
        if (isRequired && !value.trim()) return "Degree/field required";
        break;
      case "occupation":
        if (isRequired && !value.trim()) return "Occupation required";
        break;
      case "income":
        if (!/^[0-9,]+$/.test(value)) return "Numbers only (e.g., 50,000)";
        break;
      case "organization":
        if (isRequired && !value.trim()) return "Organization required";
        break;
      case "fatherName":
        if (!/^[A-Za-z\s.]+$/.test(value))
          return "Only letters, spaces and periods";
        break;
      case "fatherOccupation":
        if (isRequired && !value.trim()) return "Father's occupation required";
        break;
      case "motherName":
        if (!/^[A-Za-z\s.]+$/.test(value))
          return "Only letters, spaces and periods";
        break;
      case "motherOccupation":
        if (isRequired && !value.trim()) return "Mother's occupation required";
        break;
      case "siblings":
        if (!/^[0-9\s,]+$/.test(value)) return "Numbers only (e.g., 2 or 1,3)";
        break;
      case "familyType":
        if (!document.querySelector('input[name="familyType"]:checked'))
          return "Please select family type";
        break;
      case "familyValues":
        if (
          !Array.from(
            document.querySelectorAll('input[name="familyValues"]:checked')
          ).length
        ) {
          return "Select at least one value";
        }
        break;
      case "prefAge":
        if (!/^[0-9\s-]+$/.test(value)) return "Format: 25-30";
        break;
      case "prefHeight":
        if (!/^[0-9'\"\s-]+$/.test(value)) return "Format: 5'4\"-5'8\"";
        break;
      case "prefReligion":
        if (isRequired && !value) return "Please select preference";
        break;
      case "prefCaste":
        if (isRequired && !value.trim()) return "Caste preference required";
        break;
      case "prefEducation":
        if (isRequired && !value.trim()) return "Education preference required";
        break;
      case "prefProfession":
        if (isRequired && !value.trim())
          return "Profession preference required";
        break;
      case "aboutYourself":
        if (isRequired && value.trim().length < 50)
          return "Minimum 50 characters";
        break;
      case "partnerExpectations":
        if (isRequired && value.trim().length < 50)
          return "Minimum 50 characters";
        break;
    }

    return null;
  }

  function checkValidity(input) {
    const id = input.id;
    const value = input.value;
    const isRequired = input.hasAttribute("required");

    if (isRequired && value.trim() === "") {
      return false;
    }

    switch (id) {
      case "fullName":
        return /^[A-Za-z\s.]+$/.test(value);
      case "nickname":
        return value === "" || /^[A-Za-z\s]+$/.test(value);
      case "dateOfBirth":
        return (
          value &&
          new Date(value) <= new Date() &&
          new Date().getFullYear() - new Date(value).getFullYear() >= 18
        );
      case "age":
        return /^\d+$/.test(value) && value >= 18 && value <= 100;
      case "height":
        return /^[0-9'\"\s]+$/.test(value);
      case "weight":
        return /^[0-9\skg]+$/.test(value);
      case "gender":
        return document.querySelector('input[name="gender"]:checked');
      case "religion":
        return !isRequired || value;
      case "caste":
        return value === "" || /^[A-Za-z\s]+$/.test(value);
      case "motherTongue":
        return value === "" || /^[A-Za-z\s]+$/.test(value);
      case "email":
        return value === "" || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
      case "phone":
        return /^[+]?[0-9]{10,15}$/.test(value);
      case "address":
        return !isRequired || value.trim().length >= 10;
      case "education":
        return !isRequired || value;
      case "degree":
        return !isRequired || value.trim();
      case "occupation":
        return !isRequired || value.trim();
      case "income":
        return value === "" || /^[0-9,]+$/.test(value);
      case "organization":
        return !isRequired || value.trim();
      case "fatherName":
        return /^[A-Za-z\s.]+$/.test(value);
      case "fatherOccupation":
        return !isRequired || value.trim();
      case "motherName":
        return /^[A-Za-z\s.]+$/.test(value);
      case "motherOccupation":
        return !isRequired || value.trim();
      case "siblings":
        return value === "" || /^[0-9\s,]+$/.test(value);
      case "familyType":
        return document.querySelector('input[name="familyType"]:checked');
      case "familyValues":
        return (
          Array.from(
            document.querySelectorAll('input[name="familyValues"]:checked')
          ).length > 0
        );
      case "prefAge":
        return value === "" || /^[0-9\s-]+$/.test(value);
      case "prefHeight":
        return value === "" || /^[0-9'\"\s-]+$/.test(value);
      case "prefReligion":
        return !isRequired || value;
      case "prefCaste":
        return !isRequired || value.trim();
      case "prefEducation":
        return !isRequired || value.trim();
      case "prefProfession":
        return !isRequired || value.trim();
      case "aboutYourself":
        return !isRequired || value.trim().length >= 50;
      case "partnerExpectations":
        return !isRequired || value.trim().length >= 50;
      default:
        return true;
    }
  }

  // Form submission handler
  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", function (e) {
      let isValid = true;
      let firstInvalidElement = null;

      formElements.forEach((element) => {
        if (!checkValidity(element)) {
          validateInput({ target: element });
          isValid = false;
          if (!firstInvalidElement) {
            firstInvalidElement = element;
          }
        }
      });

      if (!isValid) {
        e.preventDefault();
        alert("Please correct the highlighted errors before submitting.");
        if (firstInvalidElement) {
          firstInvalidElement.focus();
        }
      } else {
        alert("Form submitted successfully!");
        window.location("./logic/add-biodata-logic.php");
      }
    });
  }
});
