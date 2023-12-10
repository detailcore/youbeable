export default HTTP => ({
	async apiQuestions(){
		let { data } = await HTTP
			.get('questions')
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
	
	async apiOneQuestion(alias){
		let { data } = await HTTP
			.get(`question/${alias}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
	
	async apiTopHome(){
		let { data } = await HTTP
			.get('questions/tophome')
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
	
	async apiNewHome(){
		let { data } = await HTTP
			.get('questions/newhome')
			.catch((e) => {
				console.log(e)
			});
		return data;
	},
	
	async apiUserName(id){
		let { data } = await HTTP
			.get(`user/${id}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
	
	async apiAnswerItem(id){
		let { data } = await HTTP
			.get(`answers/${id}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	}
})

