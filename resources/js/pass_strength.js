for (let i = 0; i < pass_fields.length; i++) {
  const pass = pass_fields[i];
  pass.addEventListener("input", () => {
		msg.style.display = 'block';
    if (!pass.value.match(/[a-z]/g)) {
      msg.innerHTML = `Recommendation: 
			<span style="color: red">lowercase, </span>
			<span style="color: red">uppercase, </span>
			<span style="color: red">number, </span>
			<span style="color: red">minimum 8 character </span>
			`;
    } else if (!pass.value.match(/[A-Z]/g)) {
      msg.innerHTML = `Recommendation: 
			<span style="color: lime">lowercase, </span>
			<span style="color: red">uppercase, </span>
			<span style="color: red">number, </span>
			<span style="color: red">minimum 8 character </span>
			`;
    } else if (!pass.value.match(/[0-9]/g)) {
      msg.innerHTML = `Recommendation: 
			<span style="color: lime">lowercase, </span>
			<span style="color: lime">uppercase, </span>
			<span style="color: red">number, </span>
			<span style="color: red">minimum 8 character </span>
			`;
    } else if (pass.value.length < 8) {
      msg.innerHTML = `Recommendation: 
			<span style="color: lime">lowercase, </span>
			<span style="color: lime">uppercase, </span>
			<span style="color: lime">number, </span>
			<span style="color: red">minimum 8 character </span>
			`;
    } else {
			msg.innerHTML = `Recommendation: 
			<span style="color: lime">lowercase, </span>
			<span style="color: lime">uppercase, </span>
			<span style="color: lime">number, </span>
			<span style="color: lime">minimum 8 character </span>
			`;
		}
  });
}
