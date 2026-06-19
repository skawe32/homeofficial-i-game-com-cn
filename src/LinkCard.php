<?php

namespace App\Helpers;

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $imagePath;

    public function __construct(array $config = [])
    {
        $this->url = $config['url'] ?? 'https://homeofficial-i-game.com.cn';
        $this->title = $config['title'] ?? '爱游戏 - 官方平台';
        $this->description = $config['description'] ?? '爱游戏官方平台提供丰富多样的游戏选择，带给用户极致体验。';
        $this->imagePath = $config['image'] ?? '/images/aiyouxi-card.png';
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImagePath(string $path): void
    {
        $this->imagePath = $path;
    }

    public function render(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $safeImage = htmlspecialchars($this->imagePath, ENT_QUOTES, 'UTF-8');

        $html = '<div class="link-card">';
        $html .= '<a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer" class="link-card__anchor">';
        $html .= '<div class="link-card__image-wrapper">';
        $html .= '<img src="' . $safeImage . '" alt="' . $safeTitle . '" class="link-card__image" loading="lazy" />';
        $html .= '</div>';
        $html .= '<div class="link-card__content">';
        $html .= '<h3 class="link-card__title">' . $safeTitle . '</h3>';
        $html .= '<p class="link-card__description">' . $safeDesc . '</p>';
        $html .= '<span class="link-card__url">' . $safeUrl . '</span>';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    public function renderInline(): string
    {
        $safeUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $safeTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');

        $html = '<span class="link-card-inline">';
        $html .= '<a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">';
        $html .= '<strong>' . $safeTitle . '</strong>';
        $html .= '</a>';
        $html .= '<em> — ' . $safeDesc . '</em>';
        $html .= '</span>';

        return $html;
    }

    public static function createDefault(): self
    {
        return new self([
            'url' => 'https://homeofficial-i-game.com.cn',
            'title' => '爱游戏',
            'description' => '爱游戏官方平台，畅享海量精品游戏。',
            'image' => '/images/aiyouxi-default.png',
        ]);
    }

    public static function createForArticle(string $articleTag): self
    {
        $config = [
            'url' => 'https://homeofficial-i-game.com.cn/activity/' . urlencode($articleTag),
            'title' => '爱游戏 - ' . htmlspecialchars($articleTag, ENT_QUOTES, 'UTF-8'),
            'description' => '查看爱游戏最新活动：' . htmlspecialchars($articleTag, ENT_QUOTES, 'UTF-8'),
            'image' => '/images/aiyouxi-activity.png',
        ];
        return new self($config);
    }
}