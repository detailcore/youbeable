<template>
  <div class="about_us">
    <h1>About us</h1>
    <p>
      The purpose of the "You be able" resource to provide access to Russian-speaking content of "<a target="_blank" href="https://ru.stackoverflow.com" rel="nofollow noreferrer">StackOverflow</a>" in English.
      
    </p>

    <h3>Inaccurate translation</h3>
    <p>If you've noticed errors and inaccuracy in translation, please write to us at info@youbeable.net. We will definitely correct the error.</p>

    <h3>Our plans</h3>
    <p>1. Continue to improve the quality of translation. We use manually modified text algorithms and regularly improve algorithms. </p>
    <p>2. Systematize information. We are exploring options for systematizing information to provide a ready response to the user immediately.</p>

    <h3>About Stack.</h3>
    <p>Frontal part of the website, is made with use of a framework of Vue.js, and the backend was in turn executed using Laravel framework.</p>

    <h3>About Stack Overflow</h3>
    <p>Stack Overflow — programming questions and answers system developed by Joel Spolsky and Jeff Atwood in 2008. It's part of the “Stack Exchange Network”. As in other systems of this kind, “Stack Overflow” provide an opportunity to assess questions and answers, which raises or reduces the reputation of registered users (a threat of use). The project is set up on C# using ASP.NET 4 and  ASP.NET MVC.</p>
    <p>As of July 2014, nearly 7.7 million issues had been stored in the website database. In the eight most popular topics, according to the currents, the “Stack Overflow” include the Java, C#, JavaScript, PHP, Android, jQuery, Python and  HTML.</p>
    <p>As of May 2017, the site is ranked 53rd in terms of traffic worldwide according to the Alexa Internet rating, and the number of unique visitors was 18 million in December 2010. In May 2010, the site's creators announced that the venture capital of such “Stack Overflow” was $6 million.</p>
    <p>Interesting fact: in 2016, the results of a research study showed that the designers of the programmes using the Stack Overflow are creating a much more functional code (but less secure) than those using official documentation.</p>

  </div>
</template>

<script>
export default {
  name: 'about',

  metaInfo: {
    title: 'About us',
    meta: [
      { name: 'description', content: 'The purpose of the You be able resource to provide access to Russian-speaking content of StackOverflow in English' }
    ]
  }
}
</script>


<style lang="scss" scoped>
.about_us {
  p {
    text-indent: 20px;
  }
}
</style>
