<?php

namespace App\Project\Storage\Copies;

use App\Kernel\Classes\PdoHelper;

class DatabaseCopy2019_0206-01-07-19
{
    public $createTablesSqls = array (
  0 => 'CREATE TABLE _likes (
id int(11) auto_increment,
maker_id int(11),
receiver_id int(11),
PRIMARY KEY (id),
FOREIGN KEY (maker_id) REFERENCES _users(id),
FOREIGN KEY (receiver_id) REFERENCES _users(id)
)',
  1 => 'CREATE TABLE _posts (
id int(11) auto_increment,
title varchar(255),
text text,
author int(11),
PRIMARY KEY (id),
FOREIGN KEY (author) REFERENCES _users(id)
)',
  2 => 'CREATE TABLE _posts3 (
id int(11) auto_increment,
title varchar(255),
text text,
author int(11),
PRIMARY KEY (id),
FOREIGN KEY (author) REFERENCES _users(id)
)',
  3 => 'CREATE TABLE _users (
id int(11) auto_increment,
login varchar(255),
password varchar(255),
full_name varchar(255),
date_add date,
PRIMARY KEY (id)
)',
  4 => 'CREATE TABLE requests (
id int(11) auto_increment,
request text,
created_at datetime,
PRIMARY KEY (id)
)',
);
    public $insertDataSqls = array (
  0 => 'INSERT INTO _likes VALUES(\'1\', \'1\', \'2\'), (\'2\', \'1\', \'3\'), (\'3\', \'2\', \'1\')',
  1 => 'INSERT INTO _posts VALUES(\'1\', \'box\', \'loma wins again!\', \'1\'), (\'2\', \'boxing\', \'usuk win!\', \'1\'), (\'3\', \'footbal\', \'dinamo plays again\', \'2\'), (\'4\', \'dance\', \'ama dancer ama ma dancer!\', \'2\'), (\'5\', \'nature\', \'birds fly!!\', \'3\'), (\'6\', \'test\', \'test text\', \'\'), (\'7\', \'tt\', \'text\', \'\'), (\'8\', \'tt\', \'text\', \'\'), (\'9\', \'tt\', \'text\', \'1\'), (\'10\', \'tt\', \'text\', \'1\'), (\'11\', \'tt\', \'text\', \'1\'), (\'12\', \'3\', \'4\', \'\'), (\'13\', \'3\', \'4\', \'\'), (\'14\', \'3\', \'4\', \'\'), (\'15\', \'33\', \'44\', \'\'), (\'16\', \'333\', \'444\', \'\'), (\'17\', \'777777\', \'77777\', \'\'), (\'18\', \'3\', \'4\', \'\'), (\'19\', \'33\', \'44\', \'\'), (\'20\', \'333\', \'444\', \'\'), (\'21\', \'777777\', \'77777\', \'\'), (\'22\', \'3\', \'4\', \'\'), (\'23\', \'33\', \'44\', \'\'), (\'24\', \'333\', \'444\', \'\'), (\'25\', \'777777\', \'77777\', \'\'), (\'26\', \'3\', \'4\', \'\'), (\'27\', \'33\', \'44\', \'\'), (\'28\', \'333\', \'444\', \'\'), (\'29\', \'777777\', \'77777\', \'\'), (\'30\', \'3\', \'4\', \'\'), (\'31\', \'33\', \'44\', \'\'), (\'32\', \'333\', \'444\', \'\'), (\'33\', \'777777\', \'77777\', \'\'), (\'34\', \'3\', \'4\', \'\'), (\'35\', \'33\', \'44\', \'\'), (\'36\', \'333\', \'444\', \'\'), (\'37\', \'777777\', \'77777\', \'\'), (\'38\', \'3\', \'4\', \'\'), (\'39\', \'33\', \'44\', \'\'), (\'40\', \'333\', \'444\', \'\'), (\'41\', \'777777\', \'77777\', \'\'), (\'42\', \'3\', \'4\', \'\'), (\'43\', \'33\', \'44\', \'\'), (\'44\', \'333\', \'444\', \'\'), (\'45\', \'777777\', \'77777\', \'\'), (\'46\', \'3\', \'4\', \'\'), (\'47\', \'33\', \'44\', \'\'), (\'48\', \'333\', \'444\', \'\'), (\'49\', \'777777\', \'77777\', \'\'), (\'50\', \'3\', \'4\', \'\'), (\'51\', \'33\', \'44\', \'\'), (\'52\', \'333\', \'444\', \'\'), (\'53\', \'777777\', \'77777\', \'\'), (\'54\', \'3\', \'4\', \'\'), (\'55\', \'33\', \'44\', \'\'), (\'56\', \'333\', \'444\', \'\'), (\'57\', \'777777\', \'77777\', \'\'), (\'58\', \'3\', \'4\', \'\'), (\'59\', \'33\', \'44\', \'\'), (\'60\', \'333\', \'444\', \'\'), (\'61\', \'777777\', \'77777\', \'\'), (\'62\', \'3\', \'4\', \'\'), (\'63\', \'33\', \'44\', \'\'), (\'64\', \'333\', \'444\', \'\'), (\'65\', \'777777\', \'77777\', \'\'), (\'66\', \'3\', \'4\', \'\'), (\'67\', \'33\', \'44\', \'\'), (\'68\', \'333\', \'444\', \'\'), (\'69\', \'777777\', \'77777\', \'\'), (\'70\', \'3\', \'4\', \'\'), (\'71\', \'33\', \'44\', \'\'), (\'72\', \'333\', \'444\', \'\'), (\'73\', \'777777\', \'77777\', \'\'), (\'74\', \'3\', \'4\', \'\'), (\'75\', \'33\', \'44\', \'\'), (\'76\', \'333\', \'444\', \'\'), (\'77\', \'777777\', \'77777\', \'\'), (\'78\', \'3\', \'4\', \'\'), (\'79\', \'33\', \'44\', \'\'), (\'80\', \'333\', \'444\', \'\'), (\'81\', \'777777\', \'77777\', \'\'), (\'82\', \'3\', \'4\', \'\'), (\'83\', \'33\', \'44\', \'\'), (\'84\', \'333\', \'444\', \'\'), (\'85\', \'777777\', \'77777\', \'\'), (\'86\', \'3\', \'4\', \'\'), (\'87\', \'33\', \'44\', \'\'), (\'88\', \'333\', \'444\', \'\'), (\'89\', \'777777\', \'77777\', \'\'), (\'90\', \'3\', \'4\', \'\'), (\'91\', \'33\', \'44\', \'\'), (\'92\', \'333\', \'444\', \'\'), (\'93\', \'777777\', \'77777\', \'\'), (\'94\', \'3\', \'4\', \'\'), (\'95\', \'33\', \'44\', \'\'), (\'96\', \'333\', \'444\', \'\'), (\'97\', \'777777\', \'77777\', \'\'), (\'98\', \'3\', \'4\', \'\'), (\'99\', \'33\', \'44\', \'\'), (\'100\', \'333\', \'444\', \'\'), (\'101\', \'777777\', \'77777\', \'\'), (\'102\', \'3\', \'4\', \'\'), (\'103\', \'33\', \'44\', \'\'), (\'104\', \'333\', \'444\', \'\'), (\'105\', \'777777\', \'77777\', \'\'), (\'106\', \'3\', \'4\', \'\'), (\'107\', \'33\', \'44\', \'\'), (\'108\', \'333\', \'444\', \'\'), (\'109\', \'777777\', \'77777\', \'\'), (\'110\', \'3\', \'4\', \'\'), (\'111\', \'33\', \'44\', \'\'), (\'112\', \'333\', \'444\', \'\'), (\'113\', \'777777\', \'77777\', \'\'), (\'114\', \'3\', \'4\', \'\'), (\'115\', \'33\', \'44\', \'\'), (\'116\', \'333\', \'444\', \'\'), (\'117\', \'777777\', \'77777\', \'\'), (\'118\', \'3\', \'4\', \'\'), (\'119\', \'33\', \'44\', \'\'), (\'120\', \'333\', \'444\', \'\'), (\'121\', \'777777\', \'77777\', \'\'), (\'122\', \'3\', \'4\', \'\'), (\'123\', \'33\', \'44\', \'\'), (\'124\', \'333\', \'444\', \'\'), (\'125\', \'777777\', \'77777\', \'\'), (\'126\', \'3\', \'4\', \'\'), (\'127\', \'33\', \'44\', \'\'), (\'128\', \'333\', \'444\', \'\'), (\'129\', \'777777\', \'77777\', \'\'), (\'130\', \'3\', \'4\', \'\'), (\'131\', \'33\', \'44\', \'\'), (\'132\', \'333\', \'444\', \'\'), (\'133\', \'777777\', \'77777\', \'\'), (\'134\', \'3\', \'4\', \'\'), (\'135\', \'33\', \'44\', \'\'), (\'136\', \'333\', \'444\', \'\'), (\'137\', \'777777\', \'77777\', \'\'), (\'138\', \'3\', \'4\', \'\'), (\'139\', \'33\', \'44\', \'\'), (\'140\', \'333\', \'444\', \'\'), (\'141\', \'777777\', \'77777\', \'\'), (\'142\', \'3\', \'4\', \'\'), (\'143\', \'33\', \'44\', \'\'), (\'144\', \'333\', \'444\', \'\'), (\'145\', \'777777\', \'77777\', \'\'), (\'146\', \'3\', \'4\', \'\'), (\'147\', \'33\', \'44\', \'\'), (\'148\', \'333\', \'444\', \'\'), (\'149\', \'777777\', \'77777\', \'\'), (\'150\', \'3\', \'4\', \'\'), (\'151\', \'33\', \'44\', \'\'), (\'152\', \'333\', \'444\', \'\'), (\'153\', \'777777\', \'77777\', \'\'), (\'154\', \'3\', \'4\', \'\'), (\'155\', \'33\', \'44\', \'\'), (\'156\', \'333\', \'444\', \'\'), (\'157\', \'777777\', \'77777\', \'\'), (\'158\', \'3\', \'4\', \'\'), (\'159\', \'33\', \'44\', \'\'), (\'160\', \'333\', \'444\', \'\'), (\'161\', \'777777\', \'77777\', \'\'), (\'162\', \'3\', \'4\', \'\'), (\'163\', \'33\', \'44\', \'\'), (\'164\', \'333\', \'444\', \'\'), (\'165\', \'777777\', \'77777\', \'\'), (\'166\', \'3\', \'4\', \'\'), (\'167\', \'33\', \'44\', \'\'), (\'168\', \'333\', \'444\', \'\'), (\'169\', \'777777\', \'77777\', \'\'), (\'170\', \'3\', \'4\', \'\'), (\'171\', \'33\', \'44\', \'\'), (\'172\', \'333\', \'444\', \'\'), (\'173\', \'777777\', \'77777\', \'\'), (\'174\', \'3\', \'4\', \'\'), (\'175\', \'33\', \'44\', \'\'), (\'176\', \'333\', \'444\', \'\'), (\'177\', \'777777\', \'77777\', \'\'), (\'178\', \'3\', \'4\', \'\'), (\'179\', \'33\', \'44\', \'\'), (\'180\', \'333\', \'444\', \'\'), (\'181\', \'777777\', \'77777\', \'\'), (\'182\', \'3\', \'4\', \'\'), (\'183\', \'33\', \'44\', \'\'), (\'184\', \'333\', \'444\', \'\'), (\'185\', \'777777\', \'77777\', \'\'), (\'186\', \'3\', \'4\', \'\'), (\'187\', \'33\', \'44\', \'\'), (\'188\', \'333\', \'444\', \'\'), (\'189\', \'777777\', \'77777\', \'\'), (\'190\', \'3\', \'4\', \'\'), (\'191\', \'33\', \'44\', \'\'), (\'192\', \'333\', \'444\', \'\'), (\'193\', \'777777\', \'77777\', \'\'), (\'194\', \'3\', \'4\', \'\'), (\'195\', \'33\', \'44\', \'\'), (\'196\', \'333\', \'444\', \'\'), (\'197\', \'777777\', \'77777\', \'\'), (\'198\', \'3\', \'4\', \'\'), (\'199\', \'33\', \'44\', \'\'), (\'200\', \'333\', \'444\', \'\'), (\'201\', \'777777\', \'77777\', \'\'), (\'202\', \'3\', \'4\', \'\'), (\'203\', \'33\', \'44\', \'\'), (\'204\', \'333\', \'444\', \'\'), (\'205\', \'777777\', \'77777\', \'\'), (\'206\', \'3\', \'4\', \'\'), (\'207\', \'33\', \'44\', \'\'), (\'208\', \'333\', \'444\', \'\'), (\'209\', \'777777\', \'77777\', \'\'), (\'210\', \'3\', \'4\', \'\'), (\'211\', \'33\', \'44\', \'\'), (\'212\', \'333\', \'444\', \'\'), (\'213\', \'777777\', \'77777\', \'\'), (\'214\', \'3\', \'4\', \'\'), (\'215\', \'33\', \'44\', \'\'), (\'216\', \'333\', \'444\', \'\'), (\'217\', \'777777\', \'77777\', \'\'), (\'218\', \'3\', \'4\', \'\'), (\'219\', \'33\', \'44\', \'\'), (\'220\', \'333\', \'444\', \'\'), (\'221\', \'777777\', \'77777\', \'\'), (\'222\', \'3\', \'4\', \'\'), (\'223\', \'33\', \'44\', \'\'), (\'224\', \'333\', \'444\', \'\'), (\'225\', \'777777\', \'77777\', \'\'), (\'226\', \'3\', \'4\', \'\'), (\'227\', \'33\', \'44\', \'\'), (\'228\', \'333\', \'444\', \'\'), (\'229\', \'777777\', \'77777\', \'\'), (\'230\', \'3\', \'4\', \'\'), (\'231\', \'33\', \'44\', \'\'), (\'232\', \'333\', \'444\', \'\'), (\'233\', \'777777\', \'77777\', \'\'), (\'234\', \'3\', \'4\', \'\'), (\'235\', \'33\', \'44\', \'\'), (\'236\', \'333\', \'444\', \'\'), (\'237\', \'777777\', \'77777\', \'\'), (\'238\', \'3\', \'4\', \'\'), (\'239\', \'33\', \'44\', \'\'), (\'240\', \'333\', \'444\', \'\'), (\'241\', \'777777\', \'77777\', \'\'), (\'242\', \'3\', \'4\', \'\'), (\'243\', \'33\', \'44\', \'\'), (\'244\', \'333\', \'444\', \'\'), (\'245\', \'777777\', \'77777\', \'\'), (\'246\', \'3\', \'4\', \'\'), (\'247\', \'33\', \'44\', \'\'), (\'248\', \'333\', \'444\', \'\'), (\'249\', \'777777\', \'77777\', \'\'), (\'250\', \'3\', \'4\', \'\'), (\'251\', \'33\', \'44\', \'\'), (\'252\', \'333\', \'444\', \'\'), (\'253\', \'777777\', \'77777\', \'\'), (\'254\', \'3\', \'4\', \'\'), (\'255\', \'33\', \'44\', \'\'), (\'256\', \'333\', \'444\', \'\'), (\'257\', \'777777\', \'77777\', \'\'), (\'258\', \'3\', \'4\', \'\'), (\'259\', \'33\', \'44\', \'\'), (\'260\', \'333\', \'444\', \'\'), (\'261\', \'777777\', \'77777\', \'\'), (\'262\', \'3\', \'4\', \'\'), (\'263\', \'33\', \'44\', \'\'), (\'264\', \'333\', \'444\', \'\'), (\'265\', \'777777\', \'77777\', \'\'), (\'266\', \'3\', \'4\', \'\'), (\'267\', \'33\', \'44\', \'\'), (\'268\', \'333\', \'444\', \'\'), (\'269\', \'777777\', \'77777\', \'\'), (\'270\', \'3\', \'4\', \'\'), (\'271\', \'33\', \'44\', \'\'), (\'272\', \'333\', \'444\', \'\'), (\'273\', \'777777\', \'77777\', \'\'), (\'274\', \'3\', \'4\', \'\'), (\'275\', \'33\', \'44\', \'\'), (\'276\', \'333\', \'444\', \'\'), (\'277\', \'777777\', \'77777\', \'\'), (\'278\', \'3\', \'4\', \'\'), (\'279\', \'33\', \'44\', \'\'), (\'280\', \'333\', \'444\', \'\'), (\'281\', \'777777\', \'77777\', \'\'), (\'282\', \'3\', \'4\', \'\'), (\'283\', \'33\', \'44\', \'\'), (\'284\', \'333\', \'444\', \'\'), (\'285\', \'777777\', \'77777\', \'\'), (\'286\', \'3\', \'4\', \'\'), (\'287\', \'33\', \'44\', \'\'), (\'288\', \'333\', \'444\', \'\'), (\'289\', \'777777\', \'77777\', \'\'), (\'290\', \'3\', \'4\', \'\'), (\'291\', \'33\', \'44\', \'\'), (\'292\', \'333\', \'444\', \'\'), (\'293\', \'777777\', \'77777\', \'\'), (\'294\', \'3\', \'4\', \'\'), (\'295\', \'33\', \'44\', \'\'), (\'296\', \'333\', \'444\', \'\'), (\'297\', \'777777\', \'77777\', \'\'), (\'298\', \'3\', \'4\', \'\'), (\'299\', \'33\', \'44\', \'\'), (\'300\', \'333\', \'444\', \'\'), (\'301\', \'777777\', \'77777\', \'\'), (\'302\', \'3\', \'4\', \'\'), (\'303\', \'33\', \'44\', \'\'), (\'304\', \'333\', \'444\', \'\'), (\'305\', \'777777\', \'77777\', \'\'), (\'306\', \'3\', \'4\', \'\'), (\'307\', \'33\', \'44\', \'\'), (\'308\', \'333\', \'444\', \'\'), (\'309\', \'777777\', \'77777\', \'\'), (\'310\', \'3\', \'4\', \'\'), (\'311\', \'33\', \'44\', \'\'), (\'312\', \'333\', \'444\', \'\'), (\'313\', \'777777\', \'77777\', \'\'), (\'314\', \'3\', \'4\', \'\'), (\'315\', \'33\', \'44\', \'\'), (\'316\', \'333\', \'444\', \'\'), (\'317\', \'777777\', \'77777\', \'\'), (\'318\', \'3\', \'4\', \'\'), (\'319\', \'33\', \'44\', \'\'), (\'320\', \'333\', \'444\', \'\'), (\'321\', \'777777\', \'77777\', \'\'), (\'322\', \'3\', \'4\', \'\'), (\'323\', \'33\', \'44\', \'\'), (\'324\', \'333\', \'444\', \'\'), (\'325\', \'777777\', \'77777\', \'\'), (\'326\', \'3\', \'4\', \'\'), (\'327\', \'33\', \'44\', \'\'), (\'328\', \'333\', \'444\', \'\'), (\'329\', \'777777\', \'77777\', \'\'), (\'330\', \'3\', \'4\', \'\'), (\'331\', \'33\', \'44\', \'\'), (\'332\', \'333\', \'444\', \'\'), (\'333\', \'777777\', \'77777\', \'\'), (\'334\', \'3\', \'4\', \'\'), (\'335\', \'33\', \'44\', \'\'), (\'336\', \'333\', \'444\', \'\'), (\'337\', \'777777\', \'77777\', \'\'), (\'338\', \'3\', \'4\', \'\'), (\'339\', \'33\', \'44\', \'\'), (\'340\', \'333\', \'444\', \'\'), (\'341\', \'777777\', \'77777\', \'\'), (\'342\', \'3\', \'4\', \'\'), (\'343\', \'33\', \'44\', \'\'), (\'344\', \'333\', \'444\', \'\'), (\'345\', \'777777\', \'77777\', \'\'), (\'346\', \'3\', \'4\', \'\'), (\'347\', \'33\', \'44\', \'\'), (\'348\', \'333\', \'444\', \'\'), (\'349\', \'777777\', \'77777\', \'\'), (\'350\', \'3\', \'4\', \'\'), (\'351\', \'33\', \'44\', \'\'), (\'352\', \'333\', \'444\', \'\'), (\'353\', \'777777\', \'77777\', \'\'), (\'354\', \'3\', \'4\', \'\'), (\'355\', \'33\', \'44\', \'\'), (\'356\', \'333\', \'444\', \'\'), (\'357\', \'777777\', \'77777\', \'\'), (\'358\', \'3\', \'4\', \'\'), (\'359\', \'33\', \'44\', \'\'), (\'360\', \'333\', \'444\', \'\'), (\'361\', \'777777\', \'77777\', \'\'), (\'362\', \'3\', \'4\', \'\'), (\'363\', \'33\', \'44\', \'\'), (\'364\', \'333\', \'444\', \'\'), (\'365\', \'777777\', \'77777\', \'\'), (\'366\', \'3\', \'4\', \'\'), (\'367\', \'33\', \'44\', \'\'), (\'368\', \'333\', \'444\', \'\'), (\'369\', \'777777\', \'77777\', \'\'), (\'370\', \'3\', \'4\', \'\'), (\'371\', \'33\', \'44\', \'\'), (\'372\', \'333\', \'444\', \'\'), (\'373\', \'777777\', \'77777\', \'\'), (\'374\', \'3\', \'4\', \'\'), (\'375\', \'33\', \'44\', \'\'), (\'376\', \'333\', \'444\', \'\'), (\'377\', \'777777\', \'77777\', \'\'), (\'378\', \'3\', \'4\', \'\'), (\'379\', \'33\', \'44\', \'\'), (\'380\', \'333\', \'444\', \'\'), (\'381\', \'777777\', \'77777\', \'\'), (\'382\', \'3\', \'4\', \'\'), (\'383\', \'33\', \'44\', \'\'), (\'384\', \'333\', \'444\', \'\'), (\'385\', \'777777\', \'77777\', \'\'), (\'386\', \'3\', \'4\', \'\'), (\'387\', \'33\', \'44\', \'\'), (\'388\', \'333\', \'444\', \'\'), (\'389\', \'777777\', \'77777\', \'\'), (\'390\', \'3\', \'4\', \'\'), (\'391\', \'33\', \'44\', \'\'), (\'392\', \'333\', \'444\', \'\'), (\'393\', \'777777\', \'77777\', \'\'), (\'394\', \'3\', \'4\', \'\'), (\'395\', \'33\', \'44\', \'\'), (\'396\', \'333\', \'444\', \'\'), (\'397\', \'777777\', \'77777\', \'\'), (\'398\', \'3\', \'4\', \'\'), (\'399\', \'33\', \'44\', \'\'), (\'400\', \'333\', \'444\', \'\'), (\'401\', \'777777\', \'77777\', \'\'), (\'402\', \'3\', \'4\', \'\'), (\'403\', \'33\', \'44\', \'\'), (\'404\', \'333\', \'444\', \'\'), (\'405\', \'777777\', \'77777\', \'\'), (\'406\', \'3\', \'4\', \'\'), (\'407\', \'33\', \'44\', \'\'), (\'408\', \'333\', \'444\', \'\'), (\'409\', \'777777\', \'77777\', \'\'), (\'410\', \'3\', \'4\', \'\'), (\'411\', \'33\', \'44\', \'\'), (\'412\', \'333\', \'444\', \'\'), (\'413\', \'777777\', \'77777\', \'\'), (\'414\', \'3\', \'4\', \'\'), (\'415\', \'33\', \'44\', \'\'), (\'416\', \'333\', \'444\', \'\'), (\'417\', \'777777\', \'77777\', \'\'), (\'418\', \'3\', \'4\', \'\'), (\'419\', \'33\', \'44\', \'\'), (\'420\', \'333\', \'444\', \'\'), (\'421\', \'777777\', \'77777\', \'\'), (\'422\', \'3\', \'4\', \'\'), (\'423\', \'33\', \'44\', \'\'), (\'424\', \'333\', \'444\', \'\'), (\'425\', \'777777\', \'77777\', \'\'), (\'426\', \'3\', \'4\', \'\'), (\'427\', \'33\', \'44\', \'\'), (\'428\', \'333\', \'444\', \'\'), (\'429\', \'777777\', \'77777\', \'\'), (\'430\', \'3\', \'4\', \'\'), (\'431\', \'33\', \'44\', \'\'), (\'432\', \'333\', \'444\', \'\'), (\'433\', \'777777\', \'77777\', \'\'), (\'434\', \'3\', \'4\', \'\'), (\'435\', \'33\', \'44\', \'\'), (\'436\', \'333\', \'444\', \'\'), (\'437\', \'777777\', \'77777\', \'\'), (\'438\', \'3\', \'4\', \'\'), (\'439\', \'33\', \'44\', \'\'), (\'440\', \'333\', \'444\', \'\'), (\'441\', \'777777\', \'77777\', \'\'), (\'442\', \'3\', \'4\', \'\'), (\'443\', \'33\', \'44\', \'\'), (\'444\', \'333\', \'444\', \'\'), (\'445\', \'777777\', \'77777\', \'\')',
  2 => 'INSERT INTO _posts3 VALUES(\'9\', \'54\', \'35435\', \'4\'), (\'10\', \'43\', \'5435435\', \'3\'), (\'11\', \'54\', \'35435\', \'4\')',
  3 => 'INSERT INTO _users VALUES(\'1\', \'slavamnem\', \'1234\', \'Slava Zelinskiy\', \'2018-12-18\'), (\'2\', \'vladik123\', \'1234\', \'Vlad Butnaru\', \'2018-12-18\'), (\'3\', \'dimka8\', \'333555\', \'Dima Hutor\', \'2018-12-03\'), (\'4\', \'oleg\', \'1234\', \'Oleg Petrov\', \'2018-12-12\'), (\'5\', \'nasta\', \'1234\', \'Nasta Ivanova\', \'2018-12-12\')',
  4 => 'INSERT INTO requests VALUES(\'1\', \'O:26:"AppKernelClassesRequest":4:{s:14:"controllersDir";s:32:"AppProjectackendcontrollers";s:10:"controller";s:46:"AppProjectackendcontrollersPostController";s:6:"method";s:5:"show2";s:9:"arguments";a:2:{i:0;s:1:"5";i:1;s:1:"6";}}\', \'2019-01-26 02:26:11\'), (\'2\', \'O:26:"AppKernelClassesRequest":4:{s:14:"controllersDir";s:32:"AppProjectackendcontrollers";s:10:"controller";s:32:"AppProjectackendcontrollers";s:6:"method";N;s:9:"arguments";N;}\', \'2019-01-26 02:26:11\'), (\'3\', \'O:26:"AppKernelClassesRequest":4:{s:14:"controllersDir";s:32:"AppProjectackendcontrollers";s:10:"controller";s:46:"AppProjectackendcontrollersPostController";s:6:"method";s:5:"show2";s:9:"arguments";a:2:{i:0;s:1:"5";i:1;s:1:"6";}}\', \'2019-01-26 02:26:22\'), (\'4\', \'O:26:"AppKernelClassesRequest":4:{s:14:"controllersDir";s:32:"AppProjectackendcontrollers";s:10:"controller";s:32:"AppProjectackendcontrollers";s:6:"method";N;s:9:"arguments";N;}\', \'2019-01-26 02:26:22\'), (\'5\', \'{"controllersDir":"App\\Project\\backend\\controllers\\","controller":"App\\Project\\backend\\controllers\\PostController","method":"show2","arguments":["5","6"]}\', \'2019-01-26 02:29:34\'), (\'6\', \'{"controllersDir":"App\\Project\\backend\\controllers\\","controller":"App\\Project\\backend\\controllers\\","method":null,"arguments":null}\', \'2019-01-26 02:29:35\'), (\'7\', \'111\', \'2019-01-26 00:00:12\')',
);

    public function restore()
    {
        $allQueries = $this->createTablesSqls + $this->insertDataSqls;
        foreach ($allQueries as $query) {
            dump($query);
            //$stmp = PdoHelper::getPdo()->prepare($query);
            //$stmp->execute();
        }
    }

}