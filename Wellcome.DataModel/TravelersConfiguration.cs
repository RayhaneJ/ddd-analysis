using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.DataModel
{
    [Table("TravelersConfiguration")]
    public class TravelersConfiguration
    {
        public int ID { get; set; }
        public int Adults { get; set; }
        public int Babies { get; set; }
        public int Pets { get; set; }
        public int Childs { get; set; }
    }
}
