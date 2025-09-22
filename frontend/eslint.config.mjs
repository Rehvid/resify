import { dirname } from "path";
import { fileURLToPath } from "url";
import { FlatCompat } from "@eslint/eslintrc";
import pluginReact from 'eslint-plugin-react';
import pluginPrettier from 'eslint-plugin-prettier';
import js from '@eslint/js';
import globals from 'globals';
import babelParser from '@babel/eslint-parser';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const compat = new FlatCompat({
  baseDirectory: __dirname,
});

const eslintConfig = [
  ...compat.extends("next/core-web-vitals", "next/typescript"),
  {
    ignores: [
      "node_modules/**",
      ".next/**",
      "out/**",
      "build/**",
      "next-env.d.ts",
    ],
    languageOptions: {
      globals: {
          ...globals.browser,
          ...globals.node,
          es2021: true,
      },
      parser: babelParser,
      parserOptions: {
          ecmaVersion: 2020,
          sourceType: 'module',
          ecmaFeatures: {
              jsx: true,
          },
          requireConfigFile: false,
          babelOptions: {
              plugins: ['@babel/plugin-syntax-jsx'],
          },
      },
    },
    plugins: {
        react: pluginReact,
        prettier: pluginPrettier,
    },
    rules: {
      // Prettier
      'prettier/prettier': [
          'error',
          {
              printWidth: 120,
              tabWidth: 4,
              useTabs: false,
              semi: true,
              singleQuote: true,
              trailingComma: 'all',
              bracketSpacing: true,
              arrowParens: 'always',
          },
      ],
      'no-unused-vars': 'off',
      '@typescript-eslint/no-unused-vars': ['warn', {
          argsIgnorePattern: '^_',
          varsIgnorePattern: '^(?:_|Metadata|AnotherType)$',
          ignoreRestSiblings: true,
      }],
      'no-undef': 'error',
      'no-debugger': 'error',
      'prefer-const': 'warn',
      'no-unneeded-ternary': 'warn',
      'no-nested-ternary': 'warn',
      'prefer-arrow-callback': 'warn',
      'arrow-spacing': ['warn', { before: true, after: true }],
      eqeqeq: ['error', 'always'],
      'no-shadow': 'warn',
      'consistent-return': 'error',
      'no-param-reassign': ['error', { props: true }],
      'no-empty-function': 'warn',
      'no-useless-catch': 'warn',
      'object-shorthand': ['warn', 'always'],
      curly: ['error', 'all'],

      // React
      'react/jsx-uses-react': 'off',
      'react/react-in-jsx-scope': 'off',
      'react/jsx-uses-vars': 'error',
      'react/prop-types': 'off',
    },
  },
];

export default eslintConfig;
