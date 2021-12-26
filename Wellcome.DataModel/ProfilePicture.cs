﻿using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.DataModel
{
    public class ProfilePicture
    {
        public int ID { get; set; }
        public string Path { get; set; }
        public int UserId { get; set; }
        public virtual User User { get; set; }
    }
}
