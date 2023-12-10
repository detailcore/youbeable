export default HTTP => ({
	async apiQuestions(page=1){
		let { data } = await HTTP
			.get(`questions?page=${page}`)
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

	async apiRelatedQuestion(id){
		let { data } = await HTTP
			.get('related', { params: { id: id } })
			.catch((e) => {
					console.log(e)
			});
		return data;
	},

})

