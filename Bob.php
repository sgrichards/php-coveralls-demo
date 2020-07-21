<?php

/**
 * Class Bob
 */
class Bob {

  const PROCESSORS = [
    'shouldRespondToSilence' => "Fine. Be that way!",
    'shouldRespondToShoutedQuestion' => "Calm down, I know what I'm doing!",
    'shouldRespondToQuestion' => "Sure.",
    'shouldRespondToShouting' => "Whoa, chill out!",
  ];
  const DEFAULT_RESPONSE = 'Whatever.';

  /**
   * @var string
   */
  private $input;

  /**
   * @param string $input
   *
   * @return string
   */
  function respondTo(string $input): string
  {
    $this->shouldCleanTheInput($input);

    foreach (self::PROCESSORS as $processor => $response) {
      if ($this->{$processor}() !== FALSE) {
        return $response;
      }
    }
    return self::DEFAULT_RESPONSE;
  }

  private function shouldCleanTheInput(string $input): self
  {
    $this->input = trim($input);
    return $this;
  }

  private function shouldRespondToSilence()
  {
    if (empty($this->input)) {
      return TRUE;
    }
    return FALSE;
  }

  private function shouldRespondToShoutedQuestion()
  {
    if (substr($this->input, -1) == '?' && preg_match('/[A-Z]/', $this->input) && strtoupper($this->input) == $this->input) {
      return TRUE;
    }
    return FALSE;
  }

  private function shouldRespondToQuestion()
  {
    if (substr($this->input, -1) == '?') {
      return TRUE;
    }
    return FALSE;
  }

  private function shouldRespondToShouting()
  {
    if (preg_match('/[A-Z]/', $this->input) && strtoupper($this->input) == $this->input) {
      return TRUE;
    }
    return FALSE;
  }

}
