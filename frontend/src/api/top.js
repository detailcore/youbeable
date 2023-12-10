export default server => ({
	
	async apiTopHome(){
		let { data } = await server
			.get('questions/tophome')
			.catch((e) => {
					console.log(e)
			});
		return data;
	},

	async apiNewHome(){
		let { data } = await server
			.get('questions/newhome')
			.catch((e) => {
				console.log(e)
			});
		return data;
	},

	async apiTagsTop(){
		let { data } = await server
			.get('tags/top')
			.catch((e) => {
				console.log(e)
			});
		return data;
	},

	async apiAnswerTop(){
		let { data } = await server
			.get('top/answer')
			.catch((e) => {
				console.log(e)
			});
		return data;
	},
	
	async apiTopPage(query='topnew', page=1){
		let { data } = await server
			.get(`pagetop?sort=${query}&page=${page}`)
			.catch((e) => {
				console.log(e)
			});
		return data;
	},
})

