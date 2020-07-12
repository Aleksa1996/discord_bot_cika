<?php


namespace Discord\Application\Service\Roast;


use Discord\Application\Service\ApplicationService;

abstract class RoastService implements ApplicationService
{
    /**
     * @var string[]
     */
    private $roastMe = [
        'You’re the reason God created the middle finger.',
        'You’re a grey sprinkle on a rainbow cupcake.',
        'I’m not a nerd, I’m just smarter than you.',
        'Keep rolling your eyes, you might eventually find a brain.',
        'Your face is just fine but we’ll have to put a bag over that personality.',
        'You bring everyone so much joy, when you leave the room.',
        'I thought of you today. It reminded me to take out the trash.',
        'Don’t worry about me. Worry about your eyebrows.',
        'OH MY GOD! IT SPEAKS!',
        'You are the human version of period cramps.',
        'If you’re going to be two-faced, at least make one of them pretty.',
        'You are like a cloud. When you disappear it’s a beautiful day.',
        'I’d rather treat my baby’s diaper rash than have lunch with you.',
        'Don’t worry, the first 40 years of childhood are always the hardest.',
        'I may love to shop but I will never buy your bull.',
        'I love what you’ve done with your hair. How do you get it to come out of your nostrils like that?',
        'OH MY GOD! IT SPEAKS!',
        '“Check your lipstick before you come for me.” –Naomi Smalls, RuPaul’s Drag Race',
        '“It looks like she went into Claire’s Boutique, fell on a sale rack and said, ‘I’ll take it!’” –Bianca Del Rio, RuPaul’s Drag Race',
        '“You are so full of shit, the toilet’s jealous.” –Jinkx Monsoon, RuPaul’s Drag Race',
        '“Go back to Party City, where you belong!” –Phi Phi O’Hara, RuPaul’s Drag Race',
        '“Where’d you get your outfits, girl, American Apparently Not?” –Trixie Mattel, RuPaul’s Drag Race',
        '“Impersonating Beyoncè is not your destiny, child.” –RuPaul, RuPaul’s Drag Race',
        '“Don’t get bitter, just get better.” –Alyssa Edwards, RuPaul’s Drag Race',
        'Child, I’ve forgotten more than you ever knew.',
        'You just might be why the middle finger was invented in the first place.',
        'I know you are but what am I?',
        'I see no evil, and I definitely don’t hear your evil.',
    ];

    /**
     * @var array
     */
    private $roastMention = [
        '%s, If your brain was dynamite, there wouldn’t be enough to blow your hat off.',
        '%s, You are more disappointing than an unsalted pretzel.',
        'Light travels faster than sound which is why %s seemed bright until he spoke.',
        '%s, Your kid is so annoying, he makes his Happy Meal cry.',
        '%s, You have so many gaps in your teeth it looks like your tongue is in jail.',
        '%s, Your secrets are always safe with me. I never even listen when you tell me them.',
        'I’ll never forget the first time we met %s. But I’ll keep trying.',
        'I forgot the world revolves around you %s. My apologies, how silly of me.',
        '%s, I only take you everywhere I go just so I don’t have to kiss you goodbye.',
        'Hold still. I’m trying to imagine %s with personality.',
        '%s, Our kid must have gotten his brain from you! I still have mine.',
        '%s, Your face makes onions cry.',
        '%s, You look so pretty. Not at all gross, today.',
        '%s, It’s impossible to underestimate you.',
        '%s\' teeth were so bad she could eat an apple through a fence.',
        'I’m not insulting you %s, I’m describing you.',
        '%s, You are like a cloud. When you disappear it’s a beautiful day.',
        'I’d rather treat my baby’s diaper rash than have lunch with you %s.',
        'I may love to shop but I will never buy your bull %s.',
        'I love what you’ve done with your hair %s. How do you get it to come out of your nostrils like that?'
    ];

    /**
     * @param $type
     *
     * @return mixed|string
     */
    public function getRoast($type)
    {
        if ($type == 'me') {
            return $this->roastMe[mt_rand(0, count($this->roastMe) - 1)];
        }

        return $this->roastMention[mt_rand(0, count($this->roastMention) - 1)];
    }
}