import createApp from '@/app.js';

export default context => new Promise(resolve => {
	createApp(context).then(({ app, router, store }) => {
		console.log(context);
		context.rendered = () => {
			// context.title = app.$store.getters['meta/title'];
			context.state = store.state
		}

		let params = router.currentRoute.params
		Promise.all(
			router.getMatchedComponents()
            .filter(cmp => cmp.ssrData)
            .map(cmp => cmp.ssrData({ store, params }))
		)
		.then(()=> resolve(app))
	})
});