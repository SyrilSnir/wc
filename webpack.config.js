const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');
const publicPath = '../build/';

const cssLoader = {
    loader: 'css-loader',
    options: {
        sourceMap: true
    }
  };
  const sassLoader = {
    loader: 'sass-loader',
    options: {
        sourceMap: true
    }
  };

  const resolveUrlLoader = {
    loader: 'resolve-url-loader',
    options: {
        sourceMap: true
    }
  };
  

module.exports = {
    entry: {
      main: './assets/scripts/main.js',
      dashboard: './assets/scripts/dashboard.js'
    },
    output: {
        path: path.resolve(__dirname,'web','build'),
        filename: 'scripts/[name].js',
    },
    module: {
      rules: [
        {
            test: /\.scss$/,
            use: [
              {
                loader: MiniCssExtractPlugin.loader,
                options: {
                    publicPath: '../' //publicPath
                },
              },
              cssLoader,
              {
                loader: resolveUrlLoader.loader,
                options: {
                   root: '',
                }
              },
              sassLoader
            ],
          },
          {
            test: /\.css$/,
            use: [
              {
                loader: MiniCssExtractPlugin.loader,
                options: {
                    publicPath: '../' //publicPath
                },
              },
              cssLoader,
            ],
          },          
          {
            test: /\.(png|jpg|jpeg|gif|ico|svg)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                          name: '[name].[ext]',
                          outputPath: 'fonts/'
                        }
                    }
                ]
            }, 
            {
              test: /\.(woff|woff2|eot|ttf|otf)$/,
                type: 'asset/resource',
                generator: {
                  filename: './fonts/[name].[ext]',
               },
                      
                  
              },                     
        ]
    },
    plugins: [
      new CopyWebpackPlugin({
        patterns: [
          { 
            from: 'assets/images',
            to:  'images'
          },
          { 
            from: 'assets/fonts',
            to:  'fonts'
          },            
        ]
      }),          
      new MiniCssExtractPlugin({
          filename: './css/[name].css',
       //   chunkFilename: '[id].css',
          ignoreOrder: false // Enable to remove warnings about conflicting order
       }),
    ]
  };