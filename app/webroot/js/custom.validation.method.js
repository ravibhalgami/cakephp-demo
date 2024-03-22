$.validator.addMethod(
	"lettersonly",
	function (value, element) {
		return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
	},
	"Please enter letters only"
);
$.validator.addMethod(
	"validContactNumber",
	function (value, element) {
		// Check if value is 10-digit numeric and the first digit is not 0
		return (
			this.optional(element) ||
			(/^\d{10}$/.test(value) && value.charAt(0) !== "0")
		);
	},
	"Please enter a valid 10-digit contact number"
);
