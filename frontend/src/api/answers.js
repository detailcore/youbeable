export default HTTP => ({

	async apiAnswerItem(id){
		let { data } = await HTTP
			.get(`answers/${id}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
})

