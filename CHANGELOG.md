# Change Log for Restrict Site Admins

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org/) and [Keep a CHANGELOG](http://keepachangelog.com/).

## [Unreleased]

Nothing documented right now.

## [1.0.0] - 2017-03-15

### Added

- Code to restrict anybody except Super Admins from accessing the Points Types and Modules admin screens.
  - The Modules screen can be disabled by filtering the user caps.
  - The Points Types screen uses the generic `manage_options` capability, and has to be removed manually.

[unreleased]: https://github.com/WordPoints/wordpoints/compare/master...HEAD
[1.0.0]: https://github.com/WordPoints/wordpoints/compare/...1.0.0
