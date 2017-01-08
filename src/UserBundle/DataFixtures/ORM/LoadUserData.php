<?php

namespace AppBundle\DataFixtures\ORM;

use CoreBundle\Enum\HobbyEnum;
use CoreBundle\Enum\SkillEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ResumeBundle\Entity\Customer;
use ResumeBundle\Entity\Portfolio;
use ResumeBundle\Entity\Project;
use ResumeBundle\Entity\Service;
use ResumeBundle\Entity\Skill;
use ResumeBundle\Enum\TemplateEnum;
use ResumeBundle\Enum\VisibilityEnum;
use UserBundle\Entity\Contact;
use UserBundle\Entity\Profile;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /** @var $manager ObjectManager */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        # Me
        $admin = $this->createUser
        (
            'morphinof',
            'antoine.griffon@gmail.com',
            'tbqohdux0',
            'ROLE_SUPER_ADMIN',
            true,
            array
            (
                'firstName' => 'Antoine',
                'lastName' => 'Griffon',
                'birthDate' => new \DateTime('1984-06-14'),
                'about' => '<p>I&#39;m a programmer, i love the&nbsp;<strong>web</strong>,&nbsp;i love&nbsp;<strong>PhP</strong>, i love&nbsp;<strong>Symfony&nbsp;</strong>and i love my job !</p>',
                'hobbies' => array()
            ),
            array
            (
                'email' => 'morphinof@gmail.com',
                'telephone' => '0123456789',
                'facebook' => 'morphinof',
                'skype' => 'morphinof',
                'twitter' => 'morphinof',
                'googlePlus' => 'morphinof',
                'linkedIn' => 'morphinof',
                'dribble' => 'morphinof',
                'tumblr' => 'morphinof',
            ),
            array(),
            array(),
            array(),
            array()
        );
        $this->addReference('admin', $admin);
        $this->addReference('admin-profile', $admin->getProfile());

        # John Doe
        $user = $this->createUser
        (
            'johndoe',
            'john.doe@gmail.com',
            'johndoe',
            'ROLE_USER',
            true,
            # Profile
            array
            (
                'firstName' => 'John',
                'lastName' => 'Doe',
                'birthDate' => new \DateTime('NOW'),
                'about' => '<p>I\'m just John Doe...</p>',
                'hobbies' => array()
            ),
            # Contact
            array
            (
                'email' => 'john.doe@gmail.com',
                'telephone' => '0123456789',
                'facebook' => 'john.doe',
                'skype' => 'john.doe',
                'twitter' => 'john.doe',
                'googlePlus' => 'john.doe',
                'linkedIn' => 'john.doe',
                'dribble' => 'john.doe',
                'tumblr' => 'john.doe',
            ),
            # Skills
            array
            (
                array
                (
                    'tag' => SkillEnum::HTML,
                    'level' => mt_rand() / mt_getrandmax(),
                ),
                array
                (
                    'tag' => SkillEnum::CSS,
                    'level' => mt_rand() / mt_getrandmax(),
                ),
                array
                (
                    'tag' => SkillEnum::PHP,
                    'level' => mt_rand() / mt_getrandmax(),
                ),
                array
                (
                    'tag' => SkillEnum::JQUERY,
                    'level' => mt_rand() / mt_getrandmax(),
                ),
                array
                (
                    'tag' => SkillEnum::NODE_JS,
                    'level' => mt_rand() / mt_getrandmax(),
                ),
                array
                (
                    'tag' => SkillEnum::SYMFONY_2,
                    'level' => mt_rand() / mt_getrandmax(),
                ),
                array
                (
                    'tag' => SkillEnum::SYMFONY_3,
                    'level' => mt_rand() / mt_getrandmax(),
                ),
            ),
            # Services
            array
            (
                array
                (
                    'title' => 'Développement Web',
                    'glyph' => 'code',
                    'resume' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque metus at metus tristique tincidunt.</p>'
                ),
                array
                (
                    'title' => 'Web Design',
                    'glyph' => 'pencil-square-o',
                    'resume' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque metus at metus tristique tincidunt.</p>'
                ),
                array
                (
                    'title' => 'Identité visuelle',
                    'glyph' => 'desktop',
                    'resume' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque metus at metus tristique tincidunt.</p>'
                ),
                array
                (
                    'title' => 'Vitesse de livraison',
                    'glyph' => 'bolt',
                    'resume' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque metus at metus tristique tincidunt.</p>'
                ),
                array
                (
                    'title' => 'Support 7jours/24h',
                    'glyph' => 'comments',
                    'resume' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque metus at metus tristique tincidunt.</p>'
                ),
                array
                (
                    'title' => 'Design Responsive',
                    'glyph' => 'mobile',
                    'resume' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque metus at metus tristique tincidunt.</p>'
                ),
            ),
            # Portfolio
            array
            (
                'portfolio' => array
                (
                    'title' => 'Portfolio JD',
                ),
                'projects' =>
                array
                (
                    array
                    (
                        'title' => 'Capcom',
                        'description' => 'Capcom',
                        'resume' => 'Capcom'
                    ),
                    array
                    (
                        'title' => 'Diablo III',
                        'description' => 'Diablo III',
                        'resume' => 'Diablo III'
                    ),
                    array
                    (
                        'title' => 'Starcraft II',
                        'description' => 'Starcraft II',
                        'resume' => 'Starcraft II'
                    ),
                    array
                    (
                        'title' => 'Microsoft Office',
                        'description' => 'Microsoft Office',
                        'resume' => 'Microsoft Office'
                    ),
                    array
                    (
                        'title' => 'Apple store',
                        'description' => 'Apple store',
                        'resume' => 'Apple store'
                    ),
                ),
            ),
            # Customer
            array
            (
                array
                (
                    'title' => 'Capcom',
                    'description' => 'Capcom',
                    'resume' => 'Capcom'
                ),
                array
                (
                    'title' => 'Blizzard',
                    'description' => 'Blizzard',
                    'resume' => 'Blizzard'
                ),
                array
                (
                    'title' => 'Microsoft',
                    'description' => 'Microsoft',
                    'resume' => 'Microsoft'
                ),
                array
                (
                    'title' => 'Apple',
                    'description' => 'Apple',
                    'resume' => 'Apple'
                ),
            )
        );
        $this->addReference('user', $user);
        $this->addReference('user-profile', $user->getProfile());

        $manager->flush();
    }

    /**
     * @param $userName
     * @param $email
     * @param $plainPassword
     * @param $role
     * @param $enabled
     * @param array $profile
     * @param array $contact
     * @param array $skills
     * @param array $services
     * @param array $portfolio
     * @param array $customers
     * @return User
     */
    public function createUser
    (
        $userName,
        $email,
        $plainPassword,
        $role,
        $enabled,
        array $profile,
        array $contact,
        array $skills,
        array $services,
        array $portfolio,
        array $customers
    )
    {
        $user = new User();
        $user->setUsername($userName);
        $user->setEmail($email);
        $user->setPlainPassword($plainPassword);
        $user->addRole($role);
        $user->setEnabled($enabled);

        $profile = $this->createProfile
        (
            $profile['firstName'],
            $profile['lastName'],
            $profile['birthDate'],
            $profile['about'],
            $profile['hobbies']
        );
        $profile->setOwner($user);

        $this->setContactData
        (
            $user,
            $contact
        );

        $user->setProfile($profile);
        $user->getPreferences()->setOwner($user);
        $user->getPreferences()->setTemplate(TemplateEnum::THREE_COLOR);
        $user->getPreferences()->setVisibility(VisibilityEnum::RESUME_PUBLIC);
        $user->getPreferences()->generateSeed();

        $this->manager->persist($user);

        if (!empty($skills))
        {
            foreach ($skills as $skill)
            {
                $this->createSkill($user->getProfile(), $skill['tag'], $skill['level']);
            }
        }

        if (!empty($services))
        {
            foreach ($services as $service)
            {
                $this->createService($user, $service['title'], $service['glyph'], $service['resume']);
            }
        }

        if (isset($portfolio['portfolio']) && !empty($portfolio['portfolio']))
        {
            $p = $this->createPortfolio
            (
                $user,
                $portfolio['portfolio']['title'],
                'Portfolio de '.$user->getProfile()->getFullName(),
                'Portfolio de '.$user->getProfile()->getFullName(),
                true
            );

            if (isset($portfolio['projects']) && !empty($portfolio['projects']))
            {
                foreach ($portfolio['projects'] as $project)
                {
                    $project = $this->createProject
                    (
                        $p->getOwner(),
                        $project['title'],
                        $project['description'],
                        $project['resume']
                    );
                    $p->addProject($project);
                }
            }

            $this->manager->persist($p);
        }

        if (!empty($customers))
        {
            foreach ($customers as $customer)
            {
                $this->createCustomer($user, $customer['title'], $customer['description'], $customer['resume']);
            }
        }

        return $user;
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $birthDate
     * @param $about
     * @param $hobbies
     * @return Profile
     */
    public function createProfile($firstName, $lastName, $birthDate, $about, $hobbies)
    {
        $tagRepository = $this->manager->getRepository('ApplicationSonataClassificationBundle:Tag');

        $profile = new Profile();
        $profile->setFirstName($firstName);
        $profile->setLastName($lastName);
        $profile->setBirthDate($birthDate);
        $profile->setAbout($about);
        foreach ($hobbies as $tag)
        {
            $hobby = $tagRepository->findOneBy(array('name' => $tag));

            $profile->addHobby($hobby);
        }

        return $profile;
    }

    /**
     * @param User $user
     * @param $data
     */
    public function setContactData(User $user, $data)
    {
        $user->getContact()->setEmail($data['email']);
        $user->getContact()->setTelephone($data['telephone']);
        $user->getContact()->setFacebook($data['facebook']);
        $user->getContact()->setSkype($data['skype']);
        $user->getContact()->setTwitter($data['twitter']);
        $user->getContact()->setGooglePlus($data['googlePlus']);
        $user->getContact()->setLinkedIn($data['linkedIn']);
        $user->getContact()->setDribbble($data['dribble']);
        $user->getContact()->setTumblr($data['tumblr']);

        $this->manager->persist($user->getContact());
    }

    /**
     * @param $profile
     * @param $tag
     * @param $level
     * @return null|Skill
     */
    public function createSkill($profile, $tag, $level)
    {
        $tagRepository = $this->manager->getRepository('ApplicationSonataClassificationBundle:Tag');

        $tag = $tagRepository->findOneBy(array('name' => $tag));

        if (!is_null($tag))
        {
            $skill = new Skill();
            $skill->setTag($tag);
            $skill->setLevel($level);
            $skill->setProfile($profile);

            $this->manager->persist($skill);

            return $skill;
        }

        return null;
    }

    /**
     * @param $owner
     * @param $title
     * @param $glyph
     * @param $resume
     * @return Service
     */
    public function createService($owner, $title, $glyph, $resume)
    {
        $service = new Service();
        $service->setOwner($owner);
        $service->setTitle($title);
        $service->setGlyph($glyph);
        $service->setResume($resume);

        $this->manager->persist($service);

        return $service;
    }

    /**
     * @param $owner
     * @param $title
     * @param $descritpion
     * @param $resume
     * @return Portfolio
     */
    public function createPortfolio($owner, $title, $descritpion, $resume, $mainPortfolio)
    {
        $portfolio = new Portfolio();
        $portfolio->setOwner($owner);
        $portfolio->setTitle($title);
        $portfolio->setDescription($descritpion);
        $portfolio->setResume($resume);
        $portfolio->setMainPortfolio($mainPortfolio);

        $this->manager->persist($portfolio);

        return $portfolio;
    }

    /**
     * @param $owner
     * @param $title
     * @param $description
     * @param $resume
     * @return Project
     */
    public function createProject($owner, $title, $description, $resume)
    {
        $project = new Project();
        $project->setOwner($owner);
        $project->setTitle($title);
        $project->setDescription($description);
        $project->setResume($resume);

        $this->manager->persist($project);

        return $project;
    }

    /**
     * @param $owner
     * @param $title
     * @param $description
     * @param $resume
     * @return Customer
     */
    public function createCustomer($owner, $title, $description, $resume)
    {
        $customer = new Customer();
        $customer->setOwner($owner);
        $customer->setTitle($title);
        $customer->setDescription($description);
        $customer->setResume($resume);

        $this->manager->persist($customer);

        return $customer;
    }

    public function getOrder()
    {
        return 2;
    }
}