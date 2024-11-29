// Toggle parent details when the minor checkbox is checked
document.getElementById("is_minor").addEventListener("change", function () {
    var parentDetails = document.getElementById("parent-details");
    if (this.checked) {
        parentDetails.style.display = "block";
    } else {
        parentDetails.style.display = "none";
    }
});
// Show parent details if the minor checkbox is pre-checked (for validation errors)
window.onload = function () {
    if (document.getElementById("is_minor").checked) {
        document.getElementById("parent-details").style.display = "block";
    }
};

// toggle form fields based on registration type selection
document.addEventListener("DOMContentLoaded", function () {
    const formContainer = document.getElementById("form-container");
    const newFormFields = document.getElementById("new-form-fields");
    const existingField = document.getElementById("existing-form-fields");
    const existingRadio = document.getElementById("existing_registration");
    const newRadio = document.getElementById("new_registration");
    const regNumberField = document.getElementById("reg_number_field");
    const registeredNumberInput = document.getElementById(
        "registration_number"
    );
    const submitButton = document.getElementById("submit_button");

    formContainer.style.display = "none";
    regNumberField.style.display = "none";

    function toggleFormVisibility() {
        document
            .querySelectorAll(".error-message")
            .forEach((el) => (el.innerHTML = ""));
        const formElements = formContainer.querySelectorAll(
            "input, textarea, select"
        );
        formElements.forEach((element) => {
            if (element.name === "is_minor" || element.id === "share_rate") {
                return;
            }
            if (element.type === "checkbox" || element.type === "radio") {
                element.checked = false;
            } else {
                element.value = "";
            }
        });

        formContainer.style.display = "block";
        regNumberField.style.display = "none";
        if (existingRadio.checked) {
            newFormFields.style.display = "none";
            regNumberField.style.display = "block";
            existingField.style.display = "none";
            submitButton.style.display = "none";
            registeredNumberInput.required = true;
        } else {
            newFormFields.style.display = "block";
            regNumberField.style.display = "none";
            existingField.style.display = "block";
            submitButton.style.display = "block";
            registeredNumberInput.required = false;
        }
    }

    // Show the form only when a registration type is selected
    existingRadio.addEventListener("change", toggleFormVisibility);
    newRadio.addEventListener("change", toggleFormVisibility);

    // Form submit
    const form = document.getElementById("registration-form");
    const responseMessage = document.getElementById("responseMessage");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content, // CSRF token
            },
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((error) => {
                        throw error;
                    });
                }
                return response.json();
            })
            .then((data) => {
                responseMessage.innerHTML =
                    '<p class="alert alert-success">' + data.message + "</p>";
                form.reset();
                form.scrollIntoView({
                    behavior: "smooth",
                });
                formContainer.style.display = "none";
            })
            .catch((error) => {
                // Clear previous error messages
                document
                    .querySelectorAll(".error-message")
                    .forEach((el) => (el.innerHTML = ""));

                if (error.errors) {
                    let firstErrorKey = null; // To store the first error key for scrolling

                    for (const [key, messages] of Object.entries(
                        error.errors
                    )) {
                        const errorContainer = document.getElementById(
                            `error-${key}`
                        );
                        if (errorContainer) {
                            errorContainer.innerHTML = messages[0];
                            if (!firstErrorKey) firstErrorKey = key;
                        }
                    }

                    // Scroll to the first error message if there are any errors
                    if (firstErrorKey) {
                        const firstErrorContainer = document.getElementById(
                            `error-${firstErrorKey}`
                        );
                        if (firstErrorContainer) {
                            firstErrorContainer.scrollIntoView({
                                behavior: "smooth",
                            });
                        }
                    }
                } else {
                    responseMessage.innerHTML =
                        '<p class="alert alert-danger">An error occurred. Please try again.</p>';
                }
            });
    });
});

// Search existing using registration number
document
    .getElementById("search-registration")
    .addEventListener("click", async function () {
        const registrationNumber = document.getElementById(
            "registration_number"
        ).value;
        const errorMessage = document.getElementById(
            "error-registration_number"
        );
        const bankDetails = document.getElementById("bank_details");
        const voucherContainer = document.getElementById("voucher-container");

        errorMessage.textContent = "";

        if (registrationNumber.trim() === "") {
            errorMessage.textContent = "Please enter a registration number.";
            return;
        }

        try {
            const response = await fetch(
                `/search-registration/${registrationNumber}`,
                {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                }
            );

            const data = await response.json();
            console.debug(data);

            if (data.success) {
                const fields = data.data;

                bankDetails.style.display = "none";
                voucherContainer.style.display = "none";

                Object.keys(fields).forEach((key) => {
                    const fieldValue = fields[key];

                    const radios = document.getElementsByName(key);
                    if (radios.length > 0) {
                        radios.forEach((radio) => {
                            // Set the radio as checked if its value matches the fieldValue
                            radio.checked = radio.value === fieldValue;

                            if (radio.checked) {
                                if (radio.value === "bankDeposit") {
                                    bankDetails.style.display = "block";
                                    voucherContainer.style.display = "block";
                                } else if (radio.value === "cash") {
                                    bankDetails.style.display = "none";
                                    voucherContainer.style.display = "none";
                                } else {
                                    voucherContainer.style.display = "block"; // For other values
                                }
                            }
                        });
                    }

                    const inputField = document.getElementById(key);
                    if (inputField) {
                        if (
                            inputField.tagName === "INPUT" ||
                            inputField.tagName === "TEXTAREA"
                        ) {
                            if (
                                inputField.id === "amount_in_words" ||
                                inputField.id === "investment_amount" ||
                                inputField.id === "share"
                            ) {
                                let displayField = document.getElementById(
                                    inputField.id + "_display"
                                );
                                let labelField = document.getElementById(
                                    inputField.id + "_label"
                                );

                                if (displayField) {
                                    displayField.textContent =
                                        fieldValue || "N/A";
                                    displayField.style.display = "block";
                                }

                                if (labelField) {
                                    labelField.style.display = "block";
                                }

                                const displayRow =
                                    document.getElementById("display_row");
                                if (displayRow) {
                                    displayRow.style.display = "flex";
                                }
                            } else {
                                inputField.value = fieldValue || "";
                            }
                        } else if (inputField.tagName === "SELECT") {
                            inputField.value = fieldValue || "";
                        }
                    }

                    const checkbox = document.getElementById(key);
                    if (checkbox && checkbox.type === "checkbox") {
                        checkbox.checked = Boolean(fieldValue);
                    }
                });

                const existingField = document.getElementById(
                    "existing-form-fields"
                );
                const submitButton = document.getElementById("submit_button");
                const formContainer = document.getElementById("form-container");

                if (existingField) {
                    formContainer.style.display = "block";
                    existingField.style.display = "block";
                    submitButton.style.display = "block";
                }
            } else {
                errorMessage.textContent = data.message || "No data found.";
            }
        } catch (error) {
            console.error("Error:", error);
            errorMessage.textContent = "An error occurred. Please try again.";
        }
    });

// Convert number to words (up to millions)
function numberToWords(num) {
    const singleDigits = [
        "",
        "One",
        "Two",
        "Three",
        "Four",
        "Five",
        "Six",
        "Seven",
        "Eight",
        "Nine",
    ];
    const teens = [
        "Ten",
        "Eleven",
        "Twelve",
        "Thirteen",
        "Fourteen",
        "Fifteen",
        "Sixteen",
        "Seventeen",
        "Eighteen",
        "Nineteen",
    ];
    const tens = [
        "",
        "",
        "Twenty",
        "Thirty",
        "Forty",
        "Fifty",
        "Sixty",
        "Seventy",
        "Eighty",
        "Ninety",
    ];
    const thousands = ["", "Thousand", "Million"];

    if (num === 0) return "Zero";

    let words = "";

    function toWords(n, idx) {
        if (n === 0) return "";

        let str = "";
        if (n > 99) {
            str += singleDigits[Math.floor(n / 100)] + " Hundred ";
            n %= 100;
        }
        if (n > 19) {
            str += tens[Math.floor(n / 10)] + " ";
            n %= 10;
        } else if (n > 9) {
            str += teens[n - 10] + " ";
            n = 0;
        }
        if (n > 0) {
            str += singleDigits[n] + " ";
        }

        return str.trim() + (idx > 0 ? " " + thousands[idx] : "");
    }

    let idx = 0;
    while (num > 0) {
        const chunk = num % 1000;
        if (chunk > 0) {
            words = toWords(chunk, idx) + " " + words;
        }
        num = Math.floor(num / 1000);
        idx++;
    }

    return words.trim();
}

// Update investment amount and amount in words
document.getElementById("share").addEventListener("input", function () {
    const shareRate = parseFloat(document.getElementById("share_rate").value);
    const shares = parseFloat(this.value) || 0;
    const totalAmount = shares * shareRate;

    document.getElementById("investment_amount").value = totalAmount.toFixed(2);
    document.getElementById("amount_in_words").value = numberToWords(
        Math.floor(totalAmount)
    );
});

// Payment method
document.addEventListener("DOMContentLoaded", function () {
    const paymentMethods = document.querySelectorAll(
        'input[name="payment_method"]'
    );
    const voucherContainer = document.getElementById("voucher-container");
    const bankDetails = document.getElementById("bank_details");
    bankDetails.style.display = "none";

    function toggleFields() {
        const selectedMethod = document.querySelector(
            'input[name="payment_method"]:checked'
        );

        if (!selectedMethod) return;

        const selectedMethodValue = selectedMethod.value;

        if (selectedMethodValue === "cash") {
            voucherContainer.style.display = "none";
        } else {
            voucherContainer.style.display = "block";
        }

        if (selectedMethodValue === "bankDeposit") {
            bankDetails.style.display = "block";
        } else {
            bankDetails.style.display = "none";
        }
    }

    paymentMethods.forEach((radio) => {
        radio.addEventListener("change", toggleFields);
    });

    toggleFields();
});
