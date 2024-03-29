<?php
include 'helpers/postZoho.php';
include 'helpers/curlZoho.php';
//recuperar las recetas almacenadas en zoho
$meals =  getDataZoho("recetas_Report", $_SESSION['token']);

$dataReceta[] =array(
     
  "idMeal"=> "52812",
  "strMeal"=> "Beef Brisket Pot Roast",
  "strDrinkAlternate"=> null,
  "strCategory"=> "Beef",
  "strArea"=> "American",
  "strInstructions"=> "1 Prepare the brisket for cooking: On one side of the brisket there should be a layer of fat, which you want. If there are any large chunks of fat, cut them off and discard them. Large pieces of fat will not be able to render out completely.\r\nUsing a sharp knife, score the fat in parallel lines, about 3/4-inch apart. Slice through the fat, not the beef. Repeat in the opposite direction to make a cross-hatch pattern.\r\nSalt the brisket well and let it sit at room temperature for 30 minutes.\r\n \r\n2 Sear the brisket: You'll need an oven-proof, thick-bottomed pot with a cover, or Dutch oven, that is just wide enough to hold the brisket roast with a little room for the onions.\r\nPat the brisket dry and place it, fatty side down, into the pot and place it on medium high heat. Cook for 5-8 minutes, lightly sizzling, until the fat side is nicely browned. (If the roast seems to be cooking too fast, turn the heat down to medium. You want a steady sizzle, not a raging sear.)\r\nTurn the brisket over and cook for a few minutes more to brown the other side.\r\n\r\n3 Sauté the onions and garlic: When the brisket has browned, remove it from the pot and set aside. There should be a couple tablespoons of fat rendered in the pot, if not, add some olive oil.\r\nAdd the chopped onions and increase the heat to high. Sprinkle a little salt on the onions. Sauté, stirring often, until the onions are lightly browned, 5-8 minutes. Stir in the garlic and cook 1-2 more minutes.\r\n \r\n4 Return brisket to pot, add herbs, stock, bring to simmer, cover, cook in oven: Preheat the oven to 300°F. Use kitchen twine to tie together the bay leaves, rosemary and thyme.\r\nMove the onions and garlic to the sides of the pot and nestle the brisket inside. Add the beef stock and the tied-up herbs. Bring the stock to a boil on the stovetop.\r\nCover the pot, place the pot in the 300°F oven and cook for 3 hours. Carefully flip the brisket every hour so it cooks evenly.\r\n \r\n5 Add carrots, continue to cook: After 3 hours, add the carrots. Cover the pot and cook for 1 hour more, or until the carrots are cooked through and the brisket is falling-apart tender.\r\n6 Remove brisket to cutting board, tent with foil: When the brisket is falling-apart tender, take the pot out of the oven and remove the brisket to a cutting board. Cover it with foil. Pull out and discard the herbs.\r\n7 Make sauce (optional): At this point you have two options. You can serve as is, or you can make a sauce with the drippings and some of the onions. If you serve as is, skip this step.\r\nTo make a sauce, remove the carrots and half of the onions, set aside and cover them with foil. Pour the ingredients that are remaining into the pot into a blender, and purée until smooth. If you want, add 1 tablespoon of mustard to the mix. Put into a small pot and keep warm.\r\n8 Slice the meat across the grain: Notice the lines of the muscle fibers of the roast. This is the \"grain\" of the meat. Slice the meat perpendicular to these lines, or across the grain (cutting this way further tenderizes the meat), in 1/4-inch to 1/2-inch slices.\r\nServe with the onions, carrots and gravy. Serve with mashed, roasted or boiled potatoes, egg noodles or polenta.",
  "strMealThumb"=> "https=>//www.themealdb.com/images/media/meals/ursuup1487348423.jpg",
  "strTags"=> "Meat",
  "strYoutube"=> "https=>//www.youtube.com/watch?v=gh48wM6bPWQ",
  "strIngredient1"=> "Beef Brisket",
  "strIngredient2"=> "Salt",
  "strIngredient3"=> "Onion",
  "strIngredient4"=> "Garlic",
  "strIngredient5"=> "Thyme",
  "strIngredient6"=> "Rosemary",
  "strIngredient7"=> "Bay Leaves",
  "strIngredient8"=> "beef stock",
  "strMeasure1"=> "4-5 pound",
  "strMeasure2"=> "Dash",
  "strMeasure3"=> "3",
  "strMeasure4"=> "5 cloves",
  "strMeasure5"=> "1 Sprig",
  "strMeasure6"=> "1 sprig ",
  "strMeasure7"=> "4",
  "strMeasure8"=> "2 cups",
  "strSource"=> "http://www.simplyrecipes.com/recipes/beef_brisket_pot_roast/");
  
//$meals = sendDataZoho("recetas", "1000.182825053ce6427fcfc91d807cf8462d.3ad8ad769e347bdea229ce19035ec833",$dataReceta);
?><pre>
<?php print_r($meals); ?>
</pre>