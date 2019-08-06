<?php 
header('Content-type: text/css; charset: UTF-8');
?>

@media screen and (min-width: 500px) {
  .headerContainer {
    grid-template-columns: repeat(8, 1fr);
    position: relative;
  }

  .sectionContainer {
    grid-template-columns: 1fr 1fr;
    grid-gap: 2em;
  }
}

/** Noscript CSS styles */

noscript > h2 {
  margin: 0;
  padding: 1em 1.5em 0.5em;
  color: #f00;
}

noscript > p {
  padding: 0 1.5em;
}

noscript > p > a {
  text-decoration: none;
  cursor: pointer;
  color: #ffac32;
  font-size: 1.2em;
}

noscript > p > span {
  color: #03a9f4;
}