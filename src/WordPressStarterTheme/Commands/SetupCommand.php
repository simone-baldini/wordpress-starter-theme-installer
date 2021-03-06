<?php
/**
 *
 */
namespace SimoneBaldini\WordPressStarterTheme\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Undocumented class
 */
class SetupCommand extends Command
{
    const TAGS = [
        'blog',
        'e-commerce',
        'education',
        'entertainment',
        'food-and-drink',
        'holiday',
        'news',
        'photography',
        'portfolio',
        'grid-layout',
        'one-column',
        'two-columns',
        'three-columns',
        'four-columns',
        'left-sidebar',
        'right-sidebar',
        'accessibility-ready',
        'block-patterns',
        'block-styles',
        'buddypress',
        'custom-background',
        'custom-colors',
        'custom-header',
        'custom-logo',
        'custom-menu',
        'editor-style',
        'featured-image-header',
        'featured-images',
        'flexible-header',
        'footer-widgets',
        'front-page-post-form',
        'full-site-editing',
        'full-width-template',
        'microformats',
        'post-formats',
        'rtl-language-support',
        'sticky-post',
        'theme-options',
        'threaded-comments',
        'translation-ready',
    ];

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:setup';

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('path', InputArgument::REQUIRED, 'Theme absolute path');
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $helper = $this->getHelper('question');
        $options = array_filter([
            'Theme Name' => $this->askThemeName($input, $output, $helper),
            'Theme URI' => $this->askThemeURI($input, $output, $helper),
            'Author' => $this->askAuthor($input, $output, $helper),
            'Author URI' => $this->askAuthorURI($input, $output, $helper),
            'Description' => $this->askDescription($input, $output, $helper),
            'Version' => $this->askVersion($input, $output, $helper),
            'Requires at least' => $this->askRequiresAtLeast($input, $output, $helper),
            'Tested up to' => $this->askTestedUpTo($input, $output, $helper),
            'Requires PHP' => $this->askRequiresPHP($input, $output, $helper),
            'License' => $this->askLicense($input, $output, $helper),
            'License URI' => $this->askLicenseURI($input, $output, $helper),
            'Text Domain' => $this->askTextDomain($input, $output, $helper),
            'Tags' => $this->askTags($input, $output, $helper),
        ]);

        $this->dump($input, $output, $options);
    }

    private function dump(InputInterface $input, OutputInterface $output, array $options)
    {
        $path = $input->getArgument('path');
        $output = implode("\n", array_map(
            function ($k, $v) {
                return sprintf('%s: %s', $k, $v);
            },
            array_keys($options),
            $options
        ));
        $style = <<<EOF
/*
{$output}
*/
EOF;

        file_put_contents("{$path}/style.css", $style);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askThemeName(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the theme name: ');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'Theme name cannot be empty'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askThemeURI(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the theme uri: ');
        $question->setValidator(
            function ($answer) {
                if (!empty($answer) && !filter_var($answer, FILTER_VALIDATE_URL)) {
                    throw new \RuntimeException(
                        'Enter a valid uri'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askAuthor(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the author: ');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'Author cannot be empty'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askAuthorURI(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the author uri: ');
        $question->setValidator(
            function ($answer) {
                if (!empty($answer) && !filter_var($answer, FILTER_VALIDATE_URL)) {
                    throw new \RuntimeException(
                        'Enter a valid uri'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askDescription(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter a description: ');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'Description cannot be empty'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askVersion(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the version (default 1.0.0): ', '1.0.0');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'Version cannot be empty'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askLicense(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the license (default GNU General Public License v2 or later): ', 'GNU General Public License v2 or later');

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askLicenseURI(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the license uri (default http://www.gnu.org/licenses/gpl-2.0.html): ', 'http://www.gnu.org/licenses/gpl-2.0.html');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'License URI cannot be empty'
                    );
                } elseif (!filter_var($answer, FILTER_VALIDATE_URL)) {
                    throw new \RuntimeException(
                        'Enter a valid uri'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askRequiresAtLeast(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the oldest main WordPress version the theme will work with (default 5.3): ', '5.3');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'The oldest main WordPress version the theme will work with cannot be empty'
                    );
                } elseif (!preg_match('/^[0-9]+\.[0-9]+$/', $answer)) {
                    throw new \RuntimeException(
                        'Enter a valid WordPress version (X.X format)'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askTestedUpTo(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the last main WordPress version the theme has been tested up to (default 5.6): ', '5.6');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'Last main WordPress version the theme has been tested up to cannot be empty'
                    );
                } elseif (!preg_match('/^[0-9]+\.[0-9]+$/', $answer)) {
                    throw new \RuntimeException(
                        'Enter a valid WordPress version (X.X format)'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askRequiresPHP(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the oldest PHP version supported (default 5.6): ', '5.6');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'The oldest PHP version supported cannot be empty'
                    );
                } elseif (!preg_match('/^[0-9]+\.[0-9]+$/', $answer)) {
                    throw new \RuntimeException(
                        'Enter a valid PHP version (X.X format)'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askTextDomain(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the text domain: ');
        $question->setValidator(
            function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException(
                        'The text domain cannot be empty'
                    );
                }
    
                return $answer;
            }
        );

        return $helper->ask($input, $output, $question);
    }

    /**
     * Undocumented function
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @param  mixed           $helper
     * @return string
     */
    private function askTags(InputInterface $input, OutputInterface $output, $helper)
    {
        $question = new Question('Please enter the tags: ');
        $question->setAutocompleterValues(self::TAGS);
        $tags = [];

        do {
            $answer = $helper->ask($input, $output, $question);
            $tags[] = $answer;
        } while (isset($answer));

        return implode(', ', $tags);
    }

}