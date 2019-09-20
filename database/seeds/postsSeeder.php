<?php

use Illuminate\Database\Seeder;

class postsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'England defeat',
            'body' => "For those not Australian, True Blue is a folk song that is about being Australian. The lyrics, loaded with the kind of slang undecipherable for those not living Down Under, are mainly a bunch of questions about the values and qualities that composer John Williamson wonders constitutes a true blue Australian.

            And though it's become a sort of an Australian identity since its release in 1982 - played everywhere from national rallies to state funerals - there is a school of thought, championed by Williamson himself, that its true meaning is widely misunderstood. That it was never supposed to be a song with any jingoistic connotations, as many not in favour of it have suggested, or an all-Australian musical emblem - much like Jai Ho wasn't, and Born in the USA isn't for the respective countries they represent. Ironic then that the tune you hear welcoming the players on to the ground across England, Jerusalem, was originally a William Blake poem which wasn't quite meant to be as patriotic an ode to the nation as it has since become.",
            'user_id'  => '1',
            'photo' => '1568132879.jpeg'
        ]);

        DB::table('posts')->insert([
            'title' => 'Finally, this Ashes defeat feels like it will forc',
            'body' => "For those not Australian, True Blue is a folk song that is about being Australian. The lyrics, loaded with the kind of slang undecipherable for those not living Down Under, are mainly a bunch of questions about the values and qualities that composer John Williamson wonders constitutes a true blue Australian.

            And though it's become a sort of an Australian identity since its release in 1982 - played everywhere from national rallies to state funerals - there is a school of thought, championed by Williamson himself, that its true meaning is widely misunderstood. That it was never supposed to be a song with any jingoistic connotations, as many not in favour of it have suggested, or an all-Australian musical emblem - much like Jai Ho wasn't, and Born in the USA isn't for the respective countries they represent. Ironic then that the tune you hear welcoming the players on to the ground across England, Jerusalem, was originally a William Blake poem which wasn't quite meant to be as patriotic an ode to the nation as it has since become.",
            'user_id'  => '1',
            'photo' => '1568132963.jpeg'
        ]);

        DB::table('posts')->insert([
            'title' => 'Shakib vs Afgan',
            'body' => "For those not Australian, True Blue is a folk song that is about being Australian. The lyrics, loaded with the kind of slang undecipherable for those not living Down Under, are mainly a bunch of questions about the values and qualities that composer John Williamson wonders constitutes a true blue Australian.

            And though it's become a sort of an Australian identity since its release in 1982 - played everywhere from national rallies to state funerals - there is a school of thought, championed by Williamson himself, that its true meaning is widely misunderstood. That it was never supposed to be a song with any jingoistic connotations, as many not in favour of it have suggested, or an all-Australian musical emblem - much like Jai Ho wasn't, and Born in the USA isn't for the respective countries they represent. Ironic then that the tune you hear welcoming the players on to the ground across England, Jerusalem, was originally a William Blake poem which wasn't quite meant to be as patriotic an ode to the nation as it has since become.",
            'user_id'  => '1',
            'photo' => '1568133071.jpeg'
        ]);

        DB::table('posts')->insert([
            'title' => 'Australia s Blue moment',
            'body' => "For those not Australian, True Blue is a folk song that is about being Australian. The lyrics, loaded with the kind of slang undecipherable for those not living Down Under, are mainly a bunch of questions about the values and qualities that composer John Williamson wonders constitutes a true blue Australian.

            And though it's become a sort of an Australian identity since its release in 1982 - played everywhere from national rallies to state funerals - there is a school of thought, championed by Williamson himself, that its true meaning is widely misunderstood. That it was never supposed to be a song with any jingoistic connotations, as many not in favour of it have suggested, or an all-Australian musical emblem - much like Jai Ho wasn't, and Born in the USA isn't for the respective countries they represent. Ironic then that the tune you hear welcoming the players on to the ground across England, Jerusalem, was originally a William Blake poem which wasn't quite meant to be as patriotic an ode to the nation as it has since become.",
            'user_id'  => '1',
            'photo' => '1568133555.jpeg'
        ]);

        DB::table('posts')->insert([
            'title' => "Do right-left pairs at the crease work? It's complicated",
            'body' => "For those not Australian, True Blue is a folk song that is about being Australian. The lyrics, loaded with the kind of slang undecipherable for those not living Down Under, are mainly a bunch of questions about the values and qualities that composer John Williamson wonders constitutes a true blue Australian.

            And though it's become a sort of an Australian identity since its release in 1982 - played everywhere from national rallies to state funerals - there is a school of thought, championed by Williamson himself, that its true meaning is widely misunderstood. That it was never supposed to be a song with any jingoistic connotations, as many not in favour of it have suggested, or an all-Australian musical emblem - much like Jai Ho wasn't, and Born in the USA isn't for the respective countries they represent. Ironic then that the tune you hear welcoming the players on to the ground across England, Jerusalem, was originally a William Blake poem which wasn't quite meant to be as patriotic an ode to the nation as it has since become.",
            'user_id'  => '1',
            'photo' => '1568151899.jpeg'
        ]);
    }
}
