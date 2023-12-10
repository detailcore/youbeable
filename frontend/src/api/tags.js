export default HTTP => ({

	async apiTagList(page=1){
		let { data } = await HTTP
			.get(`tags/list?page=${page}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	},

	async apiTag(tag='', page=1){
		let { data } = await HTTP
			.get(`questions/tag/${tag}?page=${page}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	},

	async apiTagDesc(payload){
		let { data } = await HTTP
			.get(`tag/${payload}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
})

